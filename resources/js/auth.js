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
            // REVISI 1: Nambahin /auth/ di URL
            const response = await fetch('/api/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    login_id: email, // Kirim sebagai login_id biar Back-End nangkep
                    kata_sandi: password
                })
            });

            const result = await response.json();

            if (response.ok) {
                const token = result.access_token;
                if(token) {
                    // REVISI 2: Samain nama kunci token dengan yang di dashboard
                    localStorage.setItem('token_laporin', token);
                }
                
                const rolePengguna = result.user ? result.user.role : 'warga';

                if (rolePengguna === 'admin') {
                    window.location.href = '/admin/dashboard';
                } else {
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
            // REVISI 3: Nambahin /auth/ di URL
            const response = await fetch('/api/auth/register', {
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