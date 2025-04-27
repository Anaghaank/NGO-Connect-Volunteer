<?php
// Include the database connection file
include 'php/db_connection.php';
// Query to get counts for completed, ongoing, upcoming events and distinct locations
$sql = "
    SELECT 
        (SELECT COUNT(*) FROM events WHERE status = 'completed') AS completed,
        (SELECT COUNT(*) FROM events WHERE status = 'ongoing') AS ongoing,
        (SELECT COUNT(*) FROM events WHERE status = 'upcoming') AS upcoming,
        (SELECT COUNT(DISTINCT location) FROM events) AS cities
";

// Query to get the count of NGOs
$sql_ngos = "SELECT COUNT(*) AS total_ngos FROM users WHERE role = 'ngo'";
$result_ngos = $conn->query($sql_ngos);
$ngo_count = 0; // Default value if no result
if ($result_ngos && $row = $result_ngos->fetch_assoc()) {
    $ngo_count = $row['total_ngos'];
}

// Query to get the count of Volunteers
$sql_volunteers = "SELECT COUNT(*) AS total_volunteers FROM users WHERE role = 'volunteer'";
$result_volunteers = $conn->query($sql_volunteers);
$volunteer_count = 0;
if ($result_volunteers && $row = $result_volunteers->fetch_assoc()) {
    $volunteer_count = $row['total_volunteers'];
}
$result = $conn->query($sql);
$data = $result->fetch_assoc();

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Volunteer Coordination Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- AOS for scroll animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS (optional if you don't have it already) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (optional, for AOS to work) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        AOS.init(); // Initialize AOS animations
    </script>


    <style>
        .hero {
            background: linear-gradient(to right, #007bff, #6610f2);
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .footer {
            background-color: #343a40;
            color: #ccc;
            padding: 20px 0;
        }

        .dashboard-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #d0e6f9;
            border-radius: 1rem;
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15);
        }
    </style>



</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">NGOConnectVolunteers</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light me-2" href="login.html">Login</a></li>
                    <li class="nav-item"><a class="btn btn-primary" href="register.html">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Image and Card -->
    <div class="container my-5 d-flex justify-content-between align-items-start" style="padding-top: 33px;">
        <!-- Left side for image -->
        <div class="colu" style="height: 300px; width: 34%;">
            <img src="assets/front_banner.png" alt="Volunteering" class="img-fluid rounded-4 shadow" />
        </div>

        <!-- Right side for the cards -->
        <div style="width: 50%; display: flex; flex-direction: column; gap: 20px;">
            <!-- First Card -->
            <div class="card p-4 rounded-4 shadow-lg text-end"
                style="background-image: linear-gradient(to right, #3db6f7, #022156);">
                <blockquote class="blockquote mb-0">
                    <p style="font-size: 1.5rem; color:aliceblue">"Volunteering is not just about giving time — it's
                        about creating change, one act of kindness at a time."</p>
                    <footer class="blockquote-footer mt-3" style="font-size: 1rem; color: antiquewhite;">Be the reason
                        someone smiles today.</footer>
                </blockquote>
            </div>

            <!-- Second Card -->
            <div class="card p-4 rounded-4 shadow-lg text-end"
                style="background-image: linear-gradient(to right, #3db6f7, #022156);">
                <blockquote class="blockquote mb-0">
                    <p style="font-size: 1.5rem; color:aliceblue">"The best way to find yourself is to lose yourself in
                        the service of others."</p>
                    <footer class="blockquote-footer mt-3" style="font-size: 1rem; color: antiquewhite;">Mahatma Gandhi
                    </footer>
                </blockquote>
            </div>
        </div>
    </div>


    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel"
        style="width: 100vw; height: 100vh; padding-top:40px">
        <div class="carousel-inner h-100">
            <!-- Slide Template -->
            <div class="carousel-item active h-100">
                <div class="row h-100 m-0">
                    <!-- Image Column -->
                    <div class="col-md-6 p-0">
                        <img src="assets/ngo1.jpg" class="d-block w-100 h-100 object-fit-cover" alt="...">
                    </div>
                    <!-- Text Column -->
                    <div class="col-md-6 d-flex align-items-center justify-content-center p-4 text-light"
                        style="background-color: #96a7bb;">
                        <div>
                            <h5 style="font-size: 2rem; color:#022156">Empowering Communities, One Step at a Time</h5>
                            <p style="font-size: 1.2rem;color:#022156">Join hands with us to uplift lives through
                                education, health, and hope. Your contribution creates lasting impact.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Repeat for Other Slides -->
            <div class="carousel-item h-100">
                <div class="row h-100 m-0">
                    <div class="col-md-6 p-0">
                        <img src="assets/ngo2.jpg" class="d-block w-100 h-100 object-fit-cover" alt="...">
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center p-4 text-light"
                        style="background-color: #96a7bb;">
                        <div>
                            <h5 style="font-size: 2rem;color:#022156">Every Small Act Counts</h5>
                            <p style="font-size: 1.2rem;color:#022156">From planting a tree to tutoring a child — small
                                steps lead to big change. Be the change you wish to see.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item h-100">
                <div class="row h-100 m-0">
                    <div class="col-md-6 p-0">
                        <img src="assets/ngo3.jpg" class="d-block w-100 h-100 object-fit-cover" alt="...">
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center p-4 text-light"
                        style="background-color: #96a7bb;">
                        <div>
                            <h5 style="font-size: 2rem;color:#022156">Volunteers Are the Heart of Change</h5>
                            <p style="font-size: 1.2rem;color:#022156">Together, we build stronger communities.
                                Volunteer today and help shape a better tomorrow.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item h-100">
                <div class="row h-100 m-0">
                    <div class="col-md-6 p-0">
                        <img src="assets/ngo4.jpg" class="d-block w-100 h-100 object-fit-cover" alt="...">
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center p-4 text-light"
                        style="background-color: #96a7bb;">
                        <div>
                            <h5 style="font-size: 2rem;color:#022156">Hope Begins With You</h5>
                            <p style="font-size: 1.2rem;color:#022156">Your time and talent can light up lives. Share
                                your skills. Inspire change. Spread kindness.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <section class="py-5 bg-white" id="about-vision-mission">
        <div class="container">
            <!-- About Us -->
            <div class="row justify-content-center text-center mb-5" id="about">
                <div class="col-lg-10">
                    <h2 class="mb-4" style="color:#0056a7;">About Us</h2>
                    <p class="mb-4 fs-5" style="color:#01101e; text-align:justify">
                        We are a passionate community of changemakers dedicated to bridging the gap between volunteers
                        and organizations in need. Our platform empowers individuals to contribute their time and
                        talents to causes they care about, making a real difference in the world—one initiative at a
                        time.
                    </p>
                    <p class="fs-5" style="color:#01101e;text-align:justify">
                        Whether you're a student seeking experience, a professional eager to give back, or an NGO
                        looking for support, our goal is to connect hearts and hands. Join us on this journey of impact,
                        inspiration, and community growth.
                    </p>
                </div>
            </div>

            <!-- Vision & Mission Cards -->
            <div class="row">
                <!-- Vision -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow p-4 h-100">
                        <h4 class="mb-3" style="color:#0056a7;">Our Vision</h4>
                        <p class="fs-5" style="color:#01101e;text-align:justify">
                            To build a world where every individual has the opportunity to make a positive impact
                            through meaningful volunteering. We envision empowered communities fueled by compassion,
                            collaboration, and shared purpose.
                        </p>
                    </div>
                </div>
                <!-- Mission -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow p-4 h-100">
                        <h4 class="mb-3" style="color:#0056a7;">Our Mission</h4>
                        <p class="fs-5" style="color:#01101e;text-align:justify">
                            Our mission is to connect passionate volunteers with NGOs and social causes that matter. We
                            aim to simplify engagement, celebrate contribution, and foster a spirit of active
                            citizenship across all communities.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" id="dashboard" style="background-color: #e9f2fb;">
        <div class="container">
            <h2 class="text-center mb-5" style="color:#0056a7;">Platform Dashboard</h2>
            <div class="row g-4 text-center">

                <!-- Card Template -->
                <!-- Events Completed -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card shadow p-4 border-0 h-100 dashboard-card">
                        <i class="bi bi-calendar-check fs-1 mb-3 text-primary"></i>
                        <h5 class="text-primary">Events Completed</h5>
                        <h2 class="fw-bold"><?php echo $data['completed']; ?></h2>
                    </div>
                </div>

                <!-- Ongoing Events -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card shadow p-4 border-0 h-100 dashboard-card">
                        <i class="bi bi-lightning-charge-fill fs-1 mb-3 text-primary"></i>
                        <h5 class="text-primary">Ongoing Events</h5>
                        <h2 class="fw-bold"><?php echo $data['ongoing']; ?></h2>
                    </div>
                </div>

                <!-- Yet to Arrive -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card shadow p-4 border-0 h-100 dashboard-card">
                        <i class="bi bi-clock-history fs-1 mb-3 text-primary"></i>
                        <h5 class="text-primary">Yet to Arrive</h5>
                        <h2 class="fw-bold"><?php echo $data['upcoming']; ?></h2>
                    </div>
                </div>

                <!-- Locations Available -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="card shadow p-4 border-0 h-100 dashboard-card">
                        <i class="bi bi-geo-alt-fill fs-1 mb-3 text-primary"></i>
                        <h5 class="text-primary">Locations Available</h5>
                        <h2 class="fw-bold"><?php echo $data['cities']; ?> Cities</h2>
                    </div>
                </div>
                <!-- Volunteers Joined -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="card shadow p-4 border-0 h-100 dashboard-card">
                        <i class="bi bi-person-check fs-1 text-primary mb-3"></i>
                        <h5 class="text-primary">Volunteers Joined</h5>
                        <h2 class="fw-bold"><?php echo $volunteer_count; ?></h2>
                    </div>
                </div>

                <!-- NGOs Connected -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="card shadow p-4 border-0 h-100 dashboard-card">
                        <i class="bi bi-building fs-1 text-primary mb-3"></i>
                        <h5 class="text-primary">NGOs Connected</h5>
                        <h2 class="fw-bold"><?php echo $ngo_count; ?></h2>
                    </div>
                </div>




                <!-- Extra Stat -->
                <div class="col-md-12" data-aos="fade-up" data-aos-delay="700">
                    <div class="card shadow p-4 border-0 mt-4 dashboard-card" style="background-color: #c3ddf6;">
                        <i class="bi bi-hourglass-split fs-1 mb-3 text-primary"></i>
                        <h5 class="mb-2 text-primary">Volunteer Hours Logged</h5>
                        <h2 class="fw-bold">15,840 hrs</h2>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5" id="hero" style="background-color: #e3f2fd;">
        <div class="container-fluid px-3 py-5"> <!-- Further reduced horizontal padding -->
            <div class="row justify-content-center text-center">
                <div class="col-xl-10 col-lg-11"> <!-- Expanded content column -->

                    <!-- Intro Paragraph -->
                    <p class="fs-5 mb-5 text-dark text-justify" style="line-height: 1.8;">
                        We believe that every individual has the power to make a difference. By connecting volunteers
                        with meaningful opportunities,
                        we aim to inspire a wave of positive change across communities. Whether you’re looking to share
                        your skills, learn from others,
                        or contribute to a cause you care about, joining our platform is the first step towards making a
                        lasting impact.
                        Empower yourself and others through purposeful volunteering — because together, we can create a
                        better tomorrow.
                    </p>

                    <!-- Reason & Eligibility Sections -->
                    <div class="row text-start gx-5">
                        <div class="col-md-6 mb-4">
                            <h4 class="fw-bold text-primary mb-3">
                                <i class="bi bi-star-fill text-warning me-2"></i>Why Join Us?
                            </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-transparent border-0 ps-0">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>Find causes that align with
                                    your values
                                </li>
                                <li class="list-group-item bg-transparent border-0 ps-0">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>Grow your skills through
                                    real-world impact
                                </li>
                                <li class="list-group-item bg-transparent border-0 ps-0">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>Join a supportive and
                                    passionate community
                                </li>
                                <li class="list-group-item bg-transparent border-0 ps-0">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>Receive recognition and
                                    rewards for your efforts
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-6 mb-4">
                            <h4 class="fw-bold text-primary mb-3">
                                <i class="bi bi-people-fill text-info me-2"></i>Who Can Join?
                            </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-transparent border-0 ps-0">
                                    <i class="bi bi-person-fill text-secondary me-2"></i>Students looking to make an
                                    impact
                                </li>
                                <li class="list-group-item bg-transparent border-0 ps-0">
                                    <i class="bi bi-person-fill text-secondary me-2"></i>Professionals eager to give
                                    back
                                </li>
                                <li class="list-group-item bg-transparent border-0 ps-0">
                                    <i class="bi bi-person-fill text-secondary me-2"></i>Retirees with a heart to serve
                                </li>
                                <li class="list-group-item bg-transparent border-0 ps-0">
                                    <i class="bi bi-person-fill text-secondary me-2"></i>Anyone willing to bring change
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Inner Card CTA -->
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-8">
                            <div class="card shadow-lg p-5 border-0 rounded-4"
                                style="background: rgba(30, 60, 114, 0.85); backdrop-filter: blur(8px);">
                                <h1 class="mb-3 text-white fw-bold">Connect. Volunteer. Inspire.</h1>
                                <p class="lead text-light">Empowering communities through purposeful volunteering.</p>
                                <a href="register.html" class="btn btn-outline-light btn-lg mt-3 px-4 rounded-pill">Join
                                    Now</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



    <!-- Features Section -->
    <section id="benefits" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold" style="color:#022156">What You Will Gain?</h2>
            <div class="row text-center g-4">

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100 bg-white">
                        <div class="display-5 mb-3">🌱</div>
                        <h4 class="fw-semibold text-dark">Personal Growth</h4>
                        <p class="text-muted">Gain confidence, develop new skills, and broaden your perspective through
                            real-world experiences.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100 bg-white">
                        <div class="display-5 mb-3">🌐</div>
                        <h4 class="fw-semibold text-dark">Meaningful Connections</h4>
                        <p class="text-muted">Meet like-minded changemakers, build friendships, and grow your
                            professional network.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100 bg-white">
                        <div class="display-5 mb-3">🎯</div>
                        <h4 class="fw-semibold text-dark">Purpose & Fulfillment</h4>
                        <p class="text-muted">Be part of something bigger than yourself and create a positive, lasting
                            impact in your community.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Contact Section -->
    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold text-primary mb-3">Get in Touch</h2>
                    <p class="text-muted">Have questions, feedback, or ideas? We’d love to hear from you! Fill out the
                        form below and we’ll get back to you soon.</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="card shadow border-0 rounded-4 p-4">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">👤 Name</label>
                                <input type="text" id="name" class="form-control" placeholder="Your full name"
                                    required />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">📧 Email</label>
                                <input type="email" id="email" class="form-control" placeholder="you@example.com"
                                    required />
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label fw-semibold">💬 Message</label>
                                <textarea id="message" rows="4" class="form-control"
                                    placeholder="Type your message here..." required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success px-4 rounded-pill">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Credits Section -->
    <footer class="bg-dark text-light py-4">
        <div class="container text-center">
            <p class="mb-2 fw-semibold">Made with ❤️ by the Team ASAP Coders</p>
            <ul class="list-inline mb-0">
                <li class="list-inline-item mx-2">Akash Nayak</li>
                <li class="list-inline-item mx-2">Shravya Shetty</li>
                <li class="list-inline-item mx-2">Anagha Ankolekar</li>
                <li class="list-inline-item mx-2">Prathamesh Kamath</li>



            </ul>



            <div class="container">
                <p>© 2025 VolunteerHub. All Rights Reserved.</p>
            </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    AOS.init(); // Initialize AOS animations
</script>

</html>