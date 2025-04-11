# 🏨 Hostel Management System (HMS)

A complete web-based application to manage hostel operations efficiently. Designed and developed using **HTML**, **CSS**, **PHP**, and **MySQL**, this system allows admins to perform essential tasks like resident management, room assignments, rent processing, guardian details, and more.

---

## 📌 Features

- 🧑‍💼 Admin login system  
- 🛏️ Add / Update / Delete Room Details  
- 👨‍👩‍👧‍👦 Add / View Resident and Guardian Information  
- 📊 Search resident data  
- 💰 Manage rent details  
- 📦 All operations interact with a backend MySQL database

---

## 🧱 Tech Stack

- **Frontend**: HTML, CSS  
- **Backend**: PHP  
- **Database**: MySQL  
- **Local Server**: XAMPP

---

## 🔧 Setup Instructions

1. Clone the repository or download the ZIP.
2. Place the project folder (`HMS`) into `C:/xampp/htdocs/`.
3. Open **XAMPP Control Panel** and start **Apache** and **MySQL**.
4. Import the SQL schema:
   - Open `phpMyAdmin` (http://localhost/phpmyadmin)
   - Create a database (e.g., `hostel`)
   - Import the file from:  
     `HMS/Project Work/hostel.sql` or `HMS/Project Work/HMS_Schema.sql`
5. Run the application in your browser:  
   `http://localhost/HMS/HMS_Main.html`

---

## 📝 Project Structure

HMS/ ├── HMS_Main.html # Home page
     ├── HMS_Resident.php # Handles resident data 
     ├── HMS_Guardian.php # Handles guardian data 
     ├── HMS_Room.php # Room management 
     ├── HMS_Rent.php # Rent management 
     ├── HMS_Search.php # Search functionality 
     ├── HMS_DisplayAll.php # Display all records 
     ├── *.html / *.css / *.php # Associated pages and styles 
     └── Project Work/ 
     ├── hostel.sql # MySQL database dump 
     ├── HMS_Project_Report.docx 
     └── HMS_Project_Presentation.pptm


---

## 📄 License

This project is licensed under the **MIT License**. See the [LICENSE](./LICENSE) file for details.

---

## 🙌 Acknowledgments

Special thanks to academic guides and peers for the support and collaboration during the development of this project.

---

## 🤝 Let's Connect

If you liked this project, feel free to ⭐ star it or connect on [GitHub](https://github.com/gvnsnkousik).

