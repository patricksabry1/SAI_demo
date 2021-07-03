# Cloud filesystem app demo

## Author
- Patrick Sabry
## Stack
- Laravel 8
- Vue JS 2/Nuxt JS framework
- Bootstrap
- MySQL 8
- AWS RDS
- AWS S3


## Solution architecture notes
- Microservice based design, major streams of business logic decoupled into independent, highly modifiable services.
- Robust token-based user authentication strategy implemented via middleware.
- S3 integration done directly through laravel middleware.
- Third party email integration done through laravel Mail fascade using SMTP.
- Data model normalised including relationship table for user-file association.

## Improvements to be made
- Leverage SQS/database queue to decouple email send process from the file upload process. Email send job should be pushed to queue and processed asynchronously to minimise load time on frontend and enhance UX.
- Build out more functionality for S3 bucket/file management, including programmatically choosing/creating specific bucket for upload.
- Build out email service to use an enterprise grade API based email send service instead of SMTP. 

## Architecture Diagram
![img.png](img.png)


## Demo Screenshots
### 1. Login Page
![img_1.png](img_1.png)

### 2. File Upload Page
![img_3.png](img_3.png)

### 3. Successful File Upload
![img_7.png](img_7.png)

### 4. Failed File Upload
![img_4.png](img_4.png)

### 5. Email Notification
![img_5.png](img_5.png)

### 6. Files table in database
![img_6.png](img_6.png)