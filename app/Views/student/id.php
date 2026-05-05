<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="<?= lang('app.appName') . ' | ' . lang('location') ?>">
    <meta name="keywords" content="<?= lang('app.appName') . ' | ' . lang('location') ?>">
    <meta name="author" content="Abou Yaziyd">
    <link rel="manifest" href="./manifest.json" />
    <meta name="theme-color" content="#3367D6">
    <title><?= lang('app.appName') ?> | <?= $title ?></title>
    <link rel="apple-touch-icon" href="<?= base_url('app-assets/images/logo/logo.svg') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('app-assets/images/logo/logo.svg') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            /* Light grey background */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding-top: 56px;
            /* Adjust for fixed navbar height */
            text-align: center;
            /* Center all body text by default */
        }

        .navbar-brand {
            font-weight: 700;
        }

        .main-content {
            flex-grow: 1;
            /* Allows content area to expand */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem 0;
            /* Add padding for content */
        }

        .id-card-container {
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            /* text-align: center; - This is now applied to body, but can stay for specificity */
            border: 2px solid #0d6efd;
            /* Bootstrap primary blue */
        }

        .student-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #0d6efd;
            /* Bootstrap primary blue */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .qr-code {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }

        /* Override Bootstrap's text-start if present in specific elements that should be centered */
        .id-card-container .text-start {
            text-align: center !important;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="id-card-container">
            <div class="flex justify-center mb-4">
                <img src="<?= base_url('app-assets/images/logo/logo.png') ?>" height="70px" alt="<?= lang('app.appName') ?>" class="h-12 w-auto object-contain">
            </div>
            <h1 class="h3 fw-bold text-dark mb-4"><?= $title ?></h1>

            <div class="mb-4">
                <img src="<?= base_url('app-assets/images/avatar/av' . ($user['sex'] == 'F' ? 'f' : '') . '.png') ?>" alt="Student Photo"
                    class="student-photo mx-auto mb-3">
                <p class="h6 fw-bold text-primary mb-1"><?= strtoupper($user['name'] . ' ' . $user['mname']) ?></p>
                <p class="h3 fw-bold text-primary mb-1"><?= strtoupper($user['lname']) ?></p>
                <p class="text-secondary small mb-0"><b><?= ucfirst(lang('app.' . $user['role'])) ?></b></p>
                <p class="text-secondary mb-0"><b><?= $user['username'] ?></b></p>
            </div>

            <!-- Removed text-start class to allow centering from parent -->
            <div class="mb-4">
                <p class="mb-1"><span class="fw-semibold"><?= lang('app.course') ?>:</span> <b><?= $course['name'] ?></b></p>
                <?php $date = $user['created_at'] ?>
                <p class="mb-1"><span class="fw-semibold"><?= lang('app.registration') ?>:</span> <?= date('Y', strtotime($date)) ?> - <?= date('Y', strtotime($date . '+3 years')) ?></p>
            </div>

            <div class="d-flex justify-content-center mb-4">
                <a href="<?= base_url('student/page/' . $user['id']) ?>" target="_blank"><img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=<?= base_url('student/page/' . $user['id']) ?>" alt="QR Code" class="qr-code"></a>
            </div>

            <p class="text-muted small mt-3"><?= lang('app.appName') ?> | <?= lang('app.ourLocation') ?></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>