    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script for AI Tips -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const aiBtn = document.getElementById('get-ai-tips-btn');
            if (aiBtn) {
                aiBtn.addEventListener('click', async function() {
                    const sparepart = this.dataset.sparepart;
                    const resultDiv = document.getElementById('ai-tips-result');

                    this.disabled = true;
                    this.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Menganalisis...';
                    resultDiv.style.display = 'block';
                    resultDiv.innerHTML = 'Meminta saran dari AI...';

                    const prompt = `Sebagai seorang mekanik ahli, berikan 3 tips perawatan singkat dalam format poin untuk mencegah kerusakan pada "${sparepart}" sepeda motor. Gunakan bahasa Indonesia.`;

                    try {
                        const tips = await callGemini(prompt);
                        resultDiv.innerHTML = tips.replace(/\n/g, '<br>');
                    } catch (error) {
                        console.error('Error:', error);
                        resultDiv.innerHTML = '<p class="text-danger">Gagal mendapatkan saran. Coba lagi nanti.</p>';
                    } finally {
                        this.disabled = false;
                        this.innerHTML = 'Minta Saran Perawatan';
                    }
                });
            }
        });

        async function callGemini(prompt) {
            const apiKey = ""; // Disediakan oleh environment
            const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;
            const payload = { contents: [{ parts: [{ text: prompt }] }] };
            
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            if (!response.ok) throw new Error(`HTTP Error: ${response.status}`);
            
            const data = await response.json();

            if (data.candidates && data.candidates[0]?.content?.parts[0]?.text) {
                return data.candidates[0].content.parts[0].text;
            } else {
                throw new Error("Respons API tidak valid.");
            }
        }
    </script>
</body>
</html>
