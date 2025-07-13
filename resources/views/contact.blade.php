<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .contact-container {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 32px 24px;
        }
        h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #333;
        }
        form label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-weight: 500;
        }
        form input, form textarea {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            background: #fafbfc;
            transition: border 0.2s;
        }
        form input:focus, form textarea:focus {
            border-color: #007bff;
            outline: none;
        }
        form textarea {
            min-height: 100px;
            resize: vertical;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        button:hover {
            background: #0056b3;
        }
        .contact-info {
            margin-top: 32px;
            text-align: center;
            color: #666;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h2>Contact Us</h2>
        <form method="POST" action="#">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Send Message</button>
        </form>
        <div class="contact-info">
            <p>Email: info@example.com</p>
            <p>Phone: +1 234 567 8901</p>
        </div>
    </div>
</body>
</html>