// ==========================================
// API LOGIN
// ==========================================
const formLogin = document.getElementById('formLogin');

if (formLogin) {
    formLogin.addEventListener('submit', async function(e) {
        e.preventDefault(); 

        const btn = document.getElementById('btnLogin');
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        btn.innerText = "MEMPROSES...";
        btn.disabled = true;

        try {
            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    email: email,
                    kata_sandi: password
                })
            });

            const result = await response.json();

            if (response.ok) {
                // Ambil token dari respons access_token buatan Back-End kamu
                const token = result.access_token;
                if(token) {
                    localStorage.setItem('api_token', token);
                }
                
                const rolePengguna = result.user ? result.user.role : 'warga';

                if (rolePengguna === 'admin') {
                    // Kalau role admin, ke panel admin
                    window.location.href = '/admin/dashboard';
                } else {
                    // Kalau warga biasa, ke dashboard lapor
                    window.location.href = '/dashboard';
                }
            } else {
                alert(result.message || 'Login gagal! Periksa email dan password kamu.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan sistem: ' + error.message);
        } finally {
            btn.innerText = "MASUK";
            btn.disabled = false;
        }
    });
}


// ==========================================
// API REGISTER
// ==========================================
function togglePass(id, btn) {
    const input = document.getElementById(id);
    const icon = btn.querySelector('i');
    
    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace('fa-eye-slash', 'fa-eye');
        icon.classList.add('text-[#D32F0F]');
    } else {
        input.type = "password";
        icon.classList.replace('fa-eye', 'fa-eye-slash');
        icon.classList.remove('text-[#D32F0F]');
    }
}

const formRegister = document.getElementById('formRegister');

if (formRegister) {
    formRegister.addEventListener('submit', async function(e) {
        e.preventDefault();

        const btn = document.getElementById('btnRegister');
        const terms = document.getElementById('terms').checked;

        if (!terms) {
            alert('Centang dulu persetujuan Syarat dan Ketentuan Layanan, Boss!');
            return;
        }

        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        btn.innerText = "MEMPROSES...";
        btn.disabled = true;

        try {
            const response = await fetch('/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                const modal = document.getElementById('modalSuccess');
                const modalContent = document.getElementById('modalContent');
                
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                
                setTimeout(() => {
                    modalContent.classList.remove('scale-95');
                    modalContent.classList.add('scale-100');
                }, 50);

            } else {
                if (response.status === 422) {
                    let pesanError = '';
                    for (const key in result) {
                        pesanError += result[key][0] + '\n';
                    }
                    alert('Gagal daftar:\n' + pesanError);
                } else {
                    alert(result.message || 'Registrasi gagal, coba lagi!');
                }
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Waduh, sistem error: ' + error.message);
        } finally {
            btn.innerText = "DAFTAR SEKARANG";
            btn.disabled = false;
        }
    });
}

const btnModalOk = document.getElementById('btnModalOk');
if (btnModalOk) {
    btnModalOk.addEventListener('click', function() {
        window.location.href = '/login';
    });
}