<!-- Script for AI Tips -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const aiBtn = document.getElementById('get-ai-tips-btn');
            if (aiBtn) {
                aiBtn.addEventListener('click', async function() {
                    const sparepart = this.dataset.sparepart;
                    const resultDiv = document.getElementById('ai-tips-result');

                    this.disabled = true;
                    this.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menganalisis...';
                    resultDiv.style.display = 'block';
                    resultDiv.innerHTML = 'Meminta saran dari AI...';

                    const prompt = `Sebagai seorang mekanik ahli, berikan 3 tips perawatan singkat dalam format poin untuk mencegah kerusakan pada "${sparepart}" sepeda motor. Gunakan bahasa Indonesia.`;

                    try {
                        const tips = await callGemini(prompt);
                        resultDiv.innerHTML = tips.replace(/\n/g, '<br>');
                    } catch (error) {
                        console.error('Error:', error);
                        resultDiv.innerHTML = '<p class="text-red-500">Gagal mendapatkan saran. Coba lagi nanti.</p>';
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
