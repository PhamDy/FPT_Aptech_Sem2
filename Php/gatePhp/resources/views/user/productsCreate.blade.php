<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Welcome Product View </h2>
    <p>This is the main page after a successful login.</p>

    <div class="row">
        <form method="post" action="">
            <div class="form-group">
                <label for="id">Id:</label>
                <input type="id" class="form-control" name="id" id="id" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="name" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="price" class="form-control" name="price" id="price" required>
            </div>
            <div class="form-group">
                <label for="img">Link img:</label>
                <input type="img" class="form-control" name="img" id="img" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Product New</button>
        </form>
    </div>
</div>
</body>
</html>
