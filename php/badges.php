<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badges</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .badge-card {
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .badge-card .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Badges Earned</h2>
        <div class="row" id="badgesList">
            <!-- Badges will be dynamically added here -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Sample data for badges (you can replace it with dynamic data)
        const badges = [
            {
                name: 'Dedicated Volunteer',
                description: 'Awarded for completing 10 hours of volunteer work.',
                dateEarned: '2025-04-20'
            },
            {
                name: 'Community Leader',
                description: 'Awarded for organizing 5 community events.',
                dateEarned: '2025-04-15'
            }
        ];

        // Dynamically adding badges to the page
        const badgesList = document.getElementById('badgesList');
        badges.forEach(badge => {
            const badgeCard = `
                <div class="col-md-4">
                    <div class="card badge-card">
                        <div class="card-body text-center">
                            <h5 class="card-title">${badge.name}</h5>
                            <p class="card-text">${badge.description}</p>
                            <small class="text-muted">${badge.dateEarned}</small>
                        </div>
                    </div>
                </div>
            `;
            badgesList.innerHTML += badgeCard;
        });
    </script>
</body>
</html>
