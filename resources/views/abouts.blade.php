<!doctype html>
<html lang="en">
@include ('partials.head')
<style>
body {
    font-family: 'Montserrat', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    color: #333;
    text-align: center;
}

.experience-header {
    position: relative;
    width: 100%;
    height: 60vh;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding-bottom: 30px;
    background-color: rgba(0, 0, 0, 0.5); 
}

.experience-header h1 {
    font-size: 55px;
    font-family: 'Georgia', serif;
    color: #FFD700; 
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
}

.exp-text, .archi-text {
    width: 70%;
    margin: 40px auto;
    font-size: 20px;
    line-height: 1.8;
    font-family: 'Times New Roman', serif;
    background-color: #F5E1C8;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-left: 6px solid #8B0000; 
}

.exp-text h1, .archi-text h1 {
    font-size: 45px;
    font-family: 'Georgia', serif;
    margin-bottom: 20px;
    color: #8B0000; 
    border-bottom: 3px solid #D4AF37;
    display: inline-block;
    padding-bottom: 5px;
}

.exp-text p, .archi-text p {
    color: #333;
}

.exp-image {
    width: 40%;
    max-width: 100%;
    margin: 30px auto;
    display: block;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.archi-images {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 20px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.archi-images img {
    width: 25%;
    max-width: 100%;
    height: auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    border-radius: 10px;
}

/* Responsive styles */
@media (max-width: 768px) {
    .experience-header {
        height: 40vh;
    }
    
    .experience-header h1 {
        font-size: 36px;
    }
    
    .exp-text, .archi-text {
        width: 90%;
        font-size: 16px;
        padding: 15px;
    }
    
    .exp-text h1, .archi-text h1 {
        font-size: 32px;
    }
    
    .exp-image {
        width: 90%;
    }
    
    .archi-images {
        flex-direction: column;
        align-items: center;
    }
    
    .archi-images img {
        width: 90%;
        margin-bottom: 15px;
    }
}

@media (max-width: 480px) {
    .experience-header h1 {
        font-size: 28px;
    }
    
    .exp-text, .archi-text {
        font-size: 14px;
    }
    
    .exp-text h1, .archi-text h1 {
        font-size: 26px;
    }
}
</style>
<body>
    @include ('partials.header')
    <div class="experience-header" 
     @isset($data[1]->mainimage)
     style="background: url('{{ asset('mainpage/'.$data[1]->mainimage) }}') no-repeat center center/cover;"
     @endisset>
     <h1>EXPERIENCE</h1>
</div>

    
    <div class="exp-text">
        <p>
            At The Star Hotel, every moment is crafted to create unforgettable memories. From the moment you step through our doors, you are greeted with warm smiles and genuine hospitality, a hallmark of the Nepali culture. Whether you're here for relaxation, adventure, or a blend of both, our hotel provides a variety of experiences tailored to meet your desires.
            <br><br>
            Our wellness spa offers traditional Ayurvedic treatments, ensuring your mind and body are in harmony. If you seek adventure, our concierge can arrange for treks, cultural tours, and more, allowing you to explore the rich history and breathtaking landscapes of Nepal. For those who prefer to unwind, our serene courtyards and rooftop garden provide the perfect setting for relaxation, offering panoramic views of the city and surrounding mountains.
            <br><br>
            Dining at The Star Hotel is an experience in itself. Our restaurant features a menu that combines international cuisine with local flavors, using fresh, locally sourced ingredients. Whether you're indulging in a hearty breakfast or savoring a candlelit dinner, our culinary team ensures that each dish is a celebration of Nepalese and global gastronomy.
            <br><br>
            The Star Hotel is not just a place to stay—it's a destination where luxury meets tradition, and where every detail is designed to enrich your experience. We invite you to discover the essence of Nepalese hospitality and make The Star Hotel your home away from home.
        </p>
    </div>
    
    <img src="{{asset('mainpage/'.$data[2]->mainimage)}}" alt="Experience Image" class="exp-image">

    <div class="archi-text">
        <h1>ARCHITECTURE</h1>
        <p>
            The architecture of The Star Hotel is a harmonious blend of Nepal's rich cultural heritage and modern luxury. Inspired by the timeless beauty of traditional Nepali homes, the design of our hotel is a tribute to the country's architectural legacy, seamlessly integrating historical elements with contemporary comforts.
            <br><br>
            <strong>Exterior Design:</strong>
            The hotel's façade is reminiscent of the classic Newari architecture found in the ancient cities of Kathmandu Valley. Characterized by intricately carved wooden windows, latticed balconies, and red brick walls, the exterior exudes an old-world charm that transports you back to the era of royal palaces and ancient temples. The sloping tiled roofs, a signature feature of traditional Nepali buildings, add to the authenticity, ensuring that The Star Hotel stands as a beacon of Nepal's architectural tradition.
            <br><br>
            <strong>Interior Design:</strong>
            Stepping inside The Star Hotel, guests are greeted by a warm and inviting ambiance, where the design ethos continues to reflect the traditional aesthetics of Nepali homes. The lobby features high ceilings supported by wooden beams and columns, adorned with detailed carvings of deities and symbols that hold cultural significance. The flooring, crafted from local stone and terracotta tiles, is inspired by the courtyards of ancient Nepali dwellings, creating a sense of continuity between the indoors and outdoors.
            <br><br>
            <strong>Rooms and Suites:</strong>
            Each room and suite is designed to be a serene retreat, echoing the simplicity and elegance of traditional Nepali interiors. The use of local materials, such as handcrafted wooden furniture and textiles woven by local artisans, adds a touch of authenticity. Earthy tones dominate the color palette, with warm reds, deep browns, and soft ochres creating a cozy and welcoming atmosphere. Large windows and balconies offer stunning views of the surrounding landscapes, ensuring that guests remain connected to the natural beauty of Nepal.
        </p>
    </div>

    <div class="archi-images">
        <img src="{{asset('mainpage/'.$data[3]->mainimage)}}" alt="Architecture Image 1">
        <img src="{{asset('mainpage/'.$data[4]->mainimage)}}" alt="Architecture Image 2">
        <img src="{{asset('mainpage/'.$data[5]->mainimage)}}" alt="Architecture Image 3">
    </div>

    @include('partials.footer')
</body>
</html>