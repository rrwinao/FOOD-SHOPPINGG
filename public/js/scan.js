// public/js/scan.js
const { BrowserMultiFormatReader } = ZXing;

function openScanner() {
    document.getElementById('scanner-container').classList.remove('hidden');
    const codeReader = new BrowserMultiFormatReader();
    codeReader.decodeFromVideoDevice(null, 'scanner', (result, error) => {
        if (result) {
            document.getElementById('scanner-container').classList.add('hidden');
            // Arahkan ke halaman terima kasih setelah QR Code terdeteksi
            window.location.href = "/thankyou";
        }
        if (error) {
            console.error(error);
        }
    });
}
