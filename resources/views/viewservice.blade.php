<!DOCTYPE html>
<html lang="en">
<head>
@include ('partials.head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #5a4a2a;
            --secondary-color: #d4af37;
            --accent-color: #c19b2e;
            --light-bg: #f8f4e9;
            --dark-text: #2a2118;
            --light-text: #6e6e6e;
            --border-radius: 8px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            line-height: 1.6;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
            color: var(--primary-color);
        }

        .amenities-section {
            padding: 4rem 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h1 {
            font-size: 2.75rem;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-header h1::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -10px;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--secondary-color);
        }

        .section-header h2 {
            font-size: 1.3rem;
            color: var(--light-text);
            font-weight: 400;
            max-width: 800px;
            margin: 0 auto;
        }

        .amenities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .amenity-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            cursor: pointer;
        }

        .amenity-image {
            height: 350px;
            overflow: hidden;
        }

        .amenity-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .amenity-card:hover .amenity-image img {
            transform: scale(1.03);
        }

        .amenity-title {
            padding: 1.5rem;
            text-align: center;
            background: white;
            font-size: 1.3rem;
            color: var(--primary-color);
            font-weight: 600;
            margin: 0;
        }

        .amenity-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: var(--box-shadow);
            position: relative;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            position: relative;
            background: linear-gradient(135deg, var(--primary-color) 0%, #3a2e1a 100%);
            color: white;
        }

        .modal-title {
            font-size: 1.75rem;
            margin: 0;
            color: var(--secondary-color);
        }

        .close-modal {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
            transition: var(--transition);
        }

        .close-modal:hover {
            color: var(--secondary-color);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
        }

        .modal-description {
            color: var(--dark-text);
            line-height: 1.8;
        }

        @media (max-width: 1024px) {
            .amenities-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .section-header h1 {
                font-size: 2.25rem;
            }
            
            .section-header h2 {
                font-size: 1.1rem;
            }
            
            .amenity-image {
                height: 300px;
            }
        }

        @media (max-width: 480px) {
            .amenities-section {
                padding: 3rem 1rem;
            }
            
            .section-header h1 {
                font-size: 2rem;
            }
            
            .amenities-grid {
                grid-template-columns: 1fr;
            }
            
            .modal-content {
                width: 95%;
            }
            
            .modal-image {
                height: 200px;
            }
        }
    </style>
</head>
<body>
@include('partials.header')

    <section class="amenities-section">
        <div class="section-header">
            <h1>Our Amenities</h1>
            <h2>Experience luxury with our premium amenities designed for your comfort</h2>
        </div>
        
        <div class="amenities-grid">
            @foreach($data as $service)
            <div class="amenity-card" onclick="openModal('{{ $service->id }}')">
                <div class="amenity-image">
                    <img src="{{ asset('service/' . $service->photo) }}" alt="{{ $service->title }}">
                </div>
                <h3 class="amenity-title">{{ $service->title }}</h3>
            </div>
            @endforeach
        </div>
    </section>

    @foreach($data as $service)
    <div id="modal-{{ $service->id }}" class="amenity-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ $service->title }}</h3>
                <span class="close-modal" onclick="closeModal('{{ $service->id }}')">&times;</span>
            </div>
            <div class="modal-body">
                <img src="{{ asset('service/' . $service->photo) }}" alt="{{ $service->title }}" class="modal-image">
                <p class="modal-description">{{ $service->description }}</p>
            </div>
        </div>
    </div>
    @endforeach

@include('partials.footer')
<script>
    function openModal(serviceId) {
        document.getElementById('modal-' + serviceId).style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeModal(serviceId) {
        document.getElementById('modal-' + serviceId).style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    window.addEventListener('click', function(event) {
        document.querySelectorAll('.amenity-modal').forEach(modal => {
            if (event.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    });
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.querySelectorAll('.amenity-modal').forEach(modal => {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            });
        }
    });
</script>

</body>
</html>
