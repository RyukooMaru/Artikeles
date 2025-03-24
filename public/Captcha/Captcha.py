from tkinter import *
import random
import os
from PIL import Image, ImageTk
import time
from tkinter import messagebox
import mysql.connector

koneksi = mysql.connector.connect(
    host="localhost",    
    user="root",      
    password="",    
    database="artikelku"
)

icon_path = os.path.abspath("Captcha/favicon.ico")
print(icon_path)  # Debugging

dp1 = Tk()
dp1.geometry("485x400")
dp1.title("Captcha Matching 2 image!")
dp1.iconbitmap(icon_path)


# Direktori tempat gambar disimpan
image_directory1 = "Captcha/gambar 1"
image_directory2 = "Captcha/gambar 2"
# Mendapatkan daftar file gambar dari direktori
image_files1 = [file for file in os.listdir(image_directory1) if file.endswith((".png", ".jpg", ".jpeg"))]
image_files2 = [file for file in os.listdir(image_directory2) if file.endswith((".png", ".jpg", ".jpeg"))]

# -------------------- GUI setup -------------------- #
dp1_lbl = Label(dp1, text="Buat gambar 2 mengikuti arah yang sama dengan gambar 1!")
dp1_lbl.pack(side="top", pady=20)

lbl_img1 = Label(dp1, text="Gambar 1")
lbl_img1.place(x=45, y=50)

lbl_img2 = Label(dp1, text="Gambar 2")
lbl_img2.place(x=350, y=50)

start_time = time.time()
time_var = StringVar()

###### Memilih gambar 1 dari direktori dengan mengubah rotasinya secara acak ######
def Gambar1():
    global random_img1, rotated_img1, img1, current_rotation_img1, lbl_img1_widget
    random_rotation1 = random.choice([45, 90, 135, 180, 225, 270, 315, 360])
    current_rotation_img1 = random_rotation1
    random_img1 = os.path.join(image_directory1, random.choice(image_files1))
    pil_img1 = Image.open(random_img1)
    rotated_img1 = pil_img1.rotate(random_rotation1)
    img1 = ImageTk.PhotoImage(rotated_img1)
    lbl_img1_widget = Label(dp1, image=img1)
    lbl_img1_widget.place(x=25, y=100)
    lbl_img1_widget.configure(image=img1)
    lbl_img1_widget.image = img1
    # Update current_rotation_img1
    current_rotation_img1 = random_rotation1
    return rotated_img1
Gambar1()

##### Memilih gambar 2 dari direktori secara acak dan melakukan perubahan rotasinya secara acak juga #####
lbl_img2_widget = None
# Function untuk mengubah gambar 2 dan rotasinya jika terdapat kondisi looping
def Gambar2():
    global random_img2, rotated_img2, img2, current_rotation_img2, lbl_img2_widget, current_rotation_img1
    while True:
        random_rotation2 = random.choice([45, 90, 135, 180, 225, 270, 315, 360])
        if random_rotation2 != current_rotation_img1:
            break
    current_rotation_img2 = random_rotation2
    random_img2 = os.path.join(image_directory2, random.choice(image_files2))
    pil_img2 = Image.open(random_img2)
    rotated_img2 = pil_img2.rotate(current_rotation_img2)
    img2 = ImageTk.PhotoImage(rotated_img2)
    if lbl_img2_widget:
        configure_img2()
    else:
        lbl_img2_widget = Label(dp1, image=img2)
        lbl_img2_widget.place(x=310, y=100)
    lbl_img2_widget.configure(image=img2)
    lbl_img2_widget.image = img2
    return rotated_img2 
# function configure
def configure_img2():
    global lbl_img2_widget
    lbl_img2_widget.configure(image=img2)
    lbl_img2_widget.image = img2
# Rotate lbl_img2 with random rotation
Gambar2()

# -------------------- Bag. Merubah rotasi gambar 2 -------------------- #
current_rotation = 0
# Function melakukan perubahan rotasi pada gambar2
def rotate_image(degrees):
    global img2, random_img2, current_rotation_img2, rotated_img2
    current_rotation_img2 = (current_rotation_img2 + degrees) % 360
    pil_img = Image.open(random_img2)
    rotated_img = pil_img.rotate(current_rotation_img2)
    img2 = ImageTk.PhotoImage(rotated_img)
    configure_img2()
    rotated_img2 = rotated_img
# Function button merubah rotasi gambar2 45Derajat ke kiri
def update_image2_kiri():
    rotate_image(45)
# Function button merubah rotasi gambar2 45Derajat ke kanan
def update_image2_kanan():
    rotate_image(-45)
btn_im2_kiri = Button(dp1, text="<", command=update_image2_kiri)
btn_im2_kiri.place(x=25, y=250)
btn_im2_kanan = Button(dp1, text=">", command=update_image2_kanan)
btn_im2_kanan.place(x=446, y=250)

# -------------------- Bag. Melakukan perulangan menggunakan waktu -------------------- #
waktu_seharusnya = 16
def check_timeout():
    global start_time, waktu_seharusnya
    current_time = time.time()
    remaining_time = max(0, waktu_seharusnya - (current_time - start_time))
    time_var.set(f"Waktu Penyelesaian: {int(remaining_time)} detik")
    lbl_tm.config(textvariable=time_var)
    if remaining_time == 0:
        messagebox.showinfo("Gambar Ulang", "Waktu Habis! Silahkan coba lagi")
        Gambar1()
        Gambar2()
        start_time = time.time()
    dp1.after(1000, check_timeout)
lbl_tm = Label(dp1, textvariable=time_var)
lbl_tm.place(x=155, y=60)
check_timeout()

# -------------------- Bag. Pencocokan rotasi gambar 1 dan 2 -------------------- #
completion_times = []
def check_rotation_match():
    global rotated_img1, rotated_img2, img2, random_img2, start_time, current_rotation_img1, current_rotation_img2, pencocokan_sedang_berlangsung, waktu_seharusnya, penutupan
    tolerance = 1e-5
    penutupan = Label(dp1, text="                                                               ")
    penutupan.place(x=155, y=60)
    waktu_seharusnya = 84000
    if current_rotation_img1 == 360:
        if current_rotation_img2 % 360 < tolerance:
            completion_time = time.time() - start_time
            completion_times.append(completion_time)
            messagebox.showinfo("Pencocokan", f"Rotasi sesuai! Anda berhasil!\n \n Waktu Penyelesaian: {int(completion_time)} detik")
            dp1.quit()
        else:
            messagebox.showinfo("Pencocokan", "Rotasi tidak sesuai! Silakan coba lagi.")
            waktu_seharusnya = 16
            Gambar1()
            Gambar2()
            start_time = time.time()
            penutupan.place_forget()
    else:
        if abs(current_rotation_img2 - current_rotation_img1) < tolerance:
            completion_time = time.time() - start_time
            completion_times.append(completion_time)
            messagebox.showinfo("Pencocokan", f"Rotasi sesuai! Anda berhasil!\n \n Waktu Penyelesaian: {int(completion_time)} detik")
            dp1.quit()
        else:
            messagebox.showinfo("Pencocokan", "Rotasi tidak sesuai! Silakan coba lagi.")
            waktu_seharusnya = 16
            Gambar1()
            Gambar2()
            start_time = time.time()
            penutupan.place_forget()

btn_check_rotation = Button(dp1, text="Cek Pencocokan", command=check_rotation_match)
btn_check_rotation.place(x=200, y=300)

# -------------------- Bag. menampilkan display -------------------- #
dp1.mainloop()
