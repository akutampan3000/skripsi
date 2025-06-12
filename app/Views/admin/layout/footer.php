<!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.getElementById('mobileMenuToggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('mobileOverlay');
            
            if (mobileToggle && sidebar && overlay) {
                mobileToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                });
                
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
                
                // Close sidebar when clicking on sidebar links (mobile)
                const sidebarLinks = sidebar.querySelectorAll('a');
                sidebarLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        if (window.innerWidth <= 768) {
                            sidebar.classList.remove('show');
                            overlay.classList.remove('show');
                        }
                    });
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const generateBtn = document.getElementById('generate-description-btn');
            if (generateBtn) {
                generateBtn.addEventListener('click', async function() {
                    const sparepartName = document.getElementById('name').value;
                    if (!sparepartName) {
                        alert('Silakan masukkan Nama Sparepart terlebih dahulu.');
                        return;
                    }

                    this.disabled = true;
                    this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generating...';

                    const prompt = `Buat deskripsi singkat (sekitar 20-30 kata) untuk produk sparepart motor bernama "${sparepartName}". Jelaskan fungsi utamanya dengan bahasa yang jelas.`;
                    
                    try {
                        const description = await callGemini(prompt);
                        document.getElementById('description').value = description;
                    } catch (error) {
                        console.error("Error calling Gemini API:", error);
                        alert("Gagal menghasilkan deskripsi. Silakan coba lagi.");
                    } finally {
                        this.disabled = false;
                        this.innerHTML = '✨ Generate AI';
                    }
                });
            }
        });

        async function callGemini(prompt) {
            const apiKey = ""; // Disediakan oleh environment
            const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;
            
            const payload = {
                contents: [{ role: "user", parts: [{ text: prompt }] }],
            };

            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            const result = await response.json();
            
            if (result.candidates && result.candidates[0]?.content?.parts[0]?.text) {
                return result.candidates[0].content.parts[0].text;
            } else {
                throw new Error("Tidak ada konten yang dihasilkan oleh API.");
            }
        }
    </script>
