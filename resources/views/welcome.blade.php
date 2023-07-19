<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
        }

        .menu-item {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .menu-item:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .menu-item img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .menu-item h3 {
            margin-bottom: 10px;
        }

        .menu-item p {
            color: #888;
            font-size: 14px;
        }
        .button {
    display: block;
    width: 50%;
    margin-top: 10px;
    background-color: #4caf50;
    color: #fff;
    text-align: center;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #45a049;
}
.item-image {
    max-width: 50%;
    height: 100px%;
    width: 100px;
}

    </style>
</head>
<body>
    <h1>Menu</h1>

    <div class="menu">
        <div class="menu-item">
        <center><img src="images/1689692175-1689373217-PHOTO-2023-07-14-14-01-42.jpg" alt="Item 1" class="item-image"></center>
            <h3>Item </h3>
            <p>Description of Item 1</p>
            <p>Price: $10</p>
            <a href="comida/" class="button">Elige tus ingredientes</a>
        </div>
        <div class="menu-item">
            <img src="path/to/image2.jpg" alt="Item 2">
            <h3>Item 2</h3>
            <p>Description of Item 2</p>
            <p>Price: $12</p>
            <a href="comida/" class="button">Elige tus ingredientes</a>

        </div>
        <div class="menu-item">
            <img src="path/to/image3.jpg" alt="Item 3">
            <h3>Item 3</h3>
            <p>Description of Item 3</p>
            <p>Price: $15</p>
        </div>

        <!-- Add more menu items here -->
    </div>
</body>
</html>
