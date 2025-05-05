<!DOCTYPE html>
<html lang="en">
@include ('partials.head')
<style>
    :root {
        --primary-color: #d4af37; 
        --secondary-color: ;
        --accent-color: #c19b2e; 
        --light-bg: #f8f4e9; 
        --text-color: #2a2118;
        --hover-color: #b38f2a; 
        --transition: all 0.3s ease-in-out;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        background-color: var(--light-bg);
        margin: 0;
        padding: 0;
        color: var(--text-color);
    }

    .gallery {
        padding: 60px 20px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .gallery h1 {
        text-align: center;
        font-size: 3rem;
        color: var(--secondary-color);
        margin-bottom: 40px;
        position: relative;
    }

    .gallery h1::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: var(--primary-color);
    }

    .gallery .row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        padding: 0;
        width: 100%; 
    }

    .gallery .col-md-3 {
        position: relative;
        overflow: hidden;
        width: 100%;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: var(--transition);
    }

    .gallery .col-md-3:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .gallery .col-md-3 img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        display: block;
        transition: var(--transition);
    }

    .gallery .col-md-3:hover img {
        transform: scale(1.05);
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.95);
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal.show {
        display: flex;
        opacity: 1;
    }

    .modal-content {
        margin: auto;
        width: 90%;
        max-width: 1200px;
        position: relative;
        animation: zoomIn 0.3s ease;
        padding: 0;
    }

    @keyframes zoomIn {
        from {transform: scale(0.9); opacity: 0;}
        to {transform: scale(1); opacity: 1;}
    }

    .modal-content img {
        width: 100%;
        height: auto;
        max-height: 90vh;
        object-fit: contain;
        display: block;
    }

    .close {
        position: absolute;
        top: 20px;
        right: 30px;
        color: var(--primary-color);
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
        transition: var(--transition);
        z-index: 2;
    }

    .close:hover {
        color: white;
        transform: rotate(90deg);
    }

    .nav-arrows {
        position: absolute;
        width: 100%;
        top: 50%;
        display: flex;
        justify-content: space-between;
        padding: 0 20px;
        transform: translateY(-50%);
        z-index: 2;
    }

    .nav-arrow {
        color: var(--primary-color);
        font-size: 3rem;
        cursor: pointer;
        background: rgba(0, 0, 0, 0.5);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }

    .nav-arrow:hover {
        background: var(--primary-color);
        color: white;
        transform: scale(1.1);
    }

    @media (max-width: 1024px) {
        .gallery .row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .gallery .row {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        
        .modal-content {
            width: 95%;
        }
        
        .nav-arrow {
            width: 50px;
            height: 50px;
            font-size: 2rem;
        }
    }

    @media (max-width: 480px) {
        .gallery h1 {
            font-size: 2.2rem;
        }
        
        .gallery .col-md-3 img {
            height: 250px;
        }
    }
</style>
<body>
    @include('partials.header')
    
    <div class="gallery">
        <h1>Our Gallery</h1>
        <div class="row">
            @foreach($data as $gallery)
                <div class="col-md-3 col-sm-6">
                    <a href="javascript:void(0)" data-image="{{asset('gallery/'.$gallery->image)}}" onclick="openModal(this)">
                        <img src="{{asset('gallery/'.$gallery->image)}}" alt="Gallery Image">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    
    @include('partials.footer')

    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="nav-arrows">
            <div class="nav-arrow prev" onclick="navigate(-1)">&#10094;</div>
            <div class="nav-arrow next" onclick="navigate(1)">&#10095;</div>
        </div>
        <div class="modal-content">
            <img id="modalImage" src="" alt="Gallery Image">
        </div>
    </div>

    <script>
        document.write('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">');
        
        let currentImageIndex = 0;
        const galleryImages = Array.from(document.querySelectorAll('.col-md-3 a')).map(img => img.getAttribute('data-image'));
        
        function openModal(element) {
            const imageSrc = element.getAttribute('data-image');
            currentImageIndex = galleryImages.indexOf(imageSrc);
            document.getElementById('myModal').classList.add('show');
            document.getElementById('modalImage').src = imageSrc;
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('myModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        function navigate(direction) {
            currentImageIndex += direction;
            
            if (currentImageIndex >= galleryImages.length) {
                currentImageIndex = 0;
            } else if (currentImageIndex < 0) {
                currentImageIndex = galleryImages.length - 1;
            }
            
            document.getElementById('modalImage').src = galleryImages[currentImageIndex];
        }

        window.onclick = function(event) {
            const modal = document.getElementById('myModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        document.addEventListener('keydown', function(event) {
            const modal = document.getElementById('myModal');
            if (modal.classList.contains('show')) {
                if (event.key === 'Escape') {
                    closeModal();
                } else if (event.key === 'ArrowRight') {
                    navigate(1);
                } else if (event.key === 'ArrowLeft') {
                    navigate(-1);
                }
            }
        });
    </script>
</body>
</html>