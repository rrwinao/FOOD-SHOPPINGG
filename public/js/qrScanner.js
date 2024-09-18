const video = document.createElement('video');
const canvasElement = document.getElementById('canvas');
const canvas = canvasElement.getContext('2d');

navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then((stream) => {
    video.srcObject = stream;
    video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
    video.play();
    requestAnimationFrame(tick);
});

function tick() {
    if (video.readyState === video.HAVE_ENOUGH_DATA) {
        canvasElement.Height = video.videoHeight;
        canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
        const imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
        const code = jsQR(imageData.data, imageData.width, imageData.height, {
            inversionAttempts: "dontInvert",
        });
        if (code) {
            console.log("QR Code Data:", code.data);
        }
    }
    requestAnimationFrame(tick);
}