function previewImage(event, imageId) {
  const file = event.target.files[0];
  const image = document.getElementById(imageId);

  if (file) {
    image.src = URL.createObjectURL(file);
    image.style.display = "block";
  }
}
