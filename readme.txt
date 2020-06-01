====================================DEMO WEBSITE DỊCH VỤ LƯU TRỮ TẬP TIN TRỰC TUYẾN====================================
==========Các môi trường cần cài đặt trước khi chạy Demo ứng dụng website==========

Xampp

=======================Thực thi Demo ứng dụng website=========================

------------------------------Bước 1---------------------------------

Tạo cơ sở dữ liệu với tên "upload" bằng Xampp với Port quy định 8888.
Thêm câu lệnh SQL trong file upload.sql được cung cấp vào HCSDL user.


------------------------------Bước 2---------------------------------

Thiết lập Port cho web server tạo trong Eclipse IDE tránh xung đột với Xampp khi chạy HCSDL với Port quy định 8080 (file báo cáo - mục 3.2.1 - hình 7.3 Port HTTP).
Thêm project vào Eclipse IDE: 
	File -> Open Projects from file System... -> Directory... -> <Đường dẫn thư mục project> -> Select folder -> Finish

------------------------------Bước 3---------------------------------

Bật Xampp để project có thể connect với database trên xampp.
Chạy project trên web server tạo bằng Tomcat trong Eclipse IDE:
	Click phải vào project -> Run As -> Run On Server -> localhost/<server đã tạo> -> Finish

------------------------------Bước 4---------------------------------

Trang login của website sẽ hiển thị trên browser mặc định, đăng nhập bằng tài khoản admin và thực thi website (admin/123456).


===============================END===================================