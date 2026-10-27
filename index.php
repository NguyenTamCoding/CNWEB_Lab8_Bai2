<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi Email</title>
    <!-- Nhúng Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="mb-4 font-weight-bold">Email tới bạn</h2>
                        
                        <form action="mail.php" enctype="multipart/form-data" method="POST">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                            </div>

                            <div class="form-group">
                                <label for="tieude">Subject</label>
                                <input type="text" class="form-control" name="tieude" id="tieude" placeholder="ten">
                            </div>

                            <div class="form-group">
                                <label for="editor">Nội dung</label>
                                <textarea name="content" id="editor" class="form-control" rows="6"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="file">File đính kèm</label>
                                <input type="file" class="form-control-file" name="file" id="file">
                            </div>

                            <button type="submit" class="btn btn-primary px-4">Gửi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tích hợp CKEditor (nếu bạn muốn hiển thị thanh công cụ soạn thảo như trong hình) -->
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
</body>
</html>