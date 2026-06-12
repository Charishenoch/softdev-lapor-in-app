<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tester API Login Lapor.in</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; padding: 20px; }
        .container { max-width: 400px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin: auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;}
        button:hover { background-color: #0056b3; }
        #hasilBox { margin-top: 20px; padding: 15px; border-radius: 4px; display: none; white-space: pre-wrap; font-family: monospace; word-wrap: break-word; font-size: 12px;}
        .sukses { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .gagal { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

<div class="container">
    <h2>Tester API Login</h2>
    <form id="formLogin">
        <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
        <div class="form-group"><label>Kata Sandi</label><input type="password" name="kata_sandi" required></div>
        <button type="submit" id="btnSubmit">Login (POST)</button>
    </form>

    <div id="hasilBox"></div>
</div>

<script>
    document.getElementById('formLogin').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const btn = document.getElementById('btnSubmit');
        const hasilBox = document.getElementById('hasilBox');
        
        btn.innerText = "Mengecek Data...";
        hasilBox.style.display = "none";
        hasilBox.className = "";

        const formData = new FormData(this);
        const dataJson = Object.fromEntries(formData.entries());

        try {
            const response = await fetch('/api/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(dataJson)
            });

            const result = await response.json();
            hasilBox.style.display = "block";
            hasilBox.innerText = JSON.stringify(result, null, 2);

            if (response.ok) {
                hasilBox.classList.add("sukses"); 
                // Token Access sangat penting buat Front-End!
                console.log("Token didapat:", result.access_token);
            } else {
                hasilBox.classList.add("gagal");
            }
        } catch (error) {
            hasilBox.style.display = "block";
            hasilBox.classList.add("gagal");
            hasilBox.innerText = "Error: " + error.message;
        } finally {
            btn.innerText = "Login (POST)";
        }
    });
</script>

</body>
</html>