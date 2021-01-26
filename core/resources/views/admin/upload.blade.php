@extends('admin.atlantis.layout')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container">
                <div class="row align-items-start">
                    <div class="p-4">
                        <h1 class="text-uppercase display-5 fw-bold">Import coupon codes</h1>
                    </div>

                    <div class="p-4 m-4 shadow card" style="width: 80% !important">
                        <form class="form" action="{{ route('upload.codes') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="drop-zone">
                                <span class="drop-zone__prompt">
                                    Drop file here or click to upload
                                </span>
                                <input type="file" name="myFile" id="" class="frop-zone__input">
                            </div>
                            <input type="submit" value="Send File" class="btn btn-info">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<style>
    .drop-zone {
    max-width: 400px;
    height: 400px;
    padding: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-weight: 500;
    font-size: 1.6rem;
    cursor: pointer;
    color: #cccccc;
    border: 4px dashed #607d8b;
    border-radius: 10px;
}

.drop-zone--over {
    border-style: solid;
}

.drop-zone__input {
    display: none;
}

.drop-zone__thumb {
    width: 100%;
    height: 100%;
    border-radius: 10px;
    overflow: hidden;
    background-color: #E0E0E0;
    background-size: cover;
    position: relative;
}

.drop-zone__thumb::after {
    content: attr(data-label);
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 5px 0;
    color: #ffffff;
    background: rgba(0, 0, 0, 0.75);
    font-size: 14px;
    text-align: center;
}

@media screen and (max-width: 420px) {
    .drop-zone {
        max-width: 100%;
        height: 200px;
    }
}

</style>

<script>
    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
    const dropZoneElement = inputElement.closest(".drop-zone");
  
    dropZoneElement.addEventListener("click", (e) => {
      inputElement.click();
    });
  
    inputElement.addEventListener("change", (e) => {
      if (inputElement.files.length) {
        updateThumbnail(dropZoneElement, inputElement.files[0]);
      }
    });
  
    dropZoneElement.addEventListener("dragover", (e) => {
      e.preventDefault();
      dropZoneElement.classList.add("drop-zone--over");
    });
  
    ["dragleave", "dragend"].forEach((type) => {
      dropZoneElement.addEventListener(type, (e) => {
        dropZoneElement.classList.remove("drop-zone--over");
      });
    });
  
    dropZoneElement.addEventListener("drop", (e) => {
      e.preventDefault();
  
      if (e.dataTransfer.files.length) {
        inputElement.files = e.dataTransfer.files;
        updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
      }
  
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });
  
  /**
   * Updates the thumbnail on a drop zone element.
   *
   * @param {HTMLElement} dropZoneElement
   * @param {File} file
   */
  function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");
  
    // First time - remove the prompt
    if (dropZoneElement.querySelector(".drop-zone__prompt")) {
      dropZoneElement.querySelector(".drop-zone__prompt").remove();
    }
  
    // First time - there is no thumbnail element, so lets create it
    if (!thumbnailElement) {
      thumbnailElement = document.createElement("div");
      thumbnailElement.classList.add("drop-zone__thumb");
      dropZoneElement.appendChild(thumbnailElement);
    }
  
    thumbnailElement.dataset.label = file.name;
  
    // Show thumbnail for image files
    if (file.type.startsWith("image/")) {
      const reader = new FileReader();
  
      reader.readAsDataURL(file);
      reader.onload = () => {
        thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
      };
    } else {
      thumbnailElement.style.backgroundImage = null;
    }
  }
  
</script>