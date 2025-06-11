body {
    background: #f8f9fa;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

header {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1);
}

.sidebar .nav-link {
    padding: 10px 15px;
    margin: 5px 0;
    border-radius: 5px;
    transition: background 0.3s;
}

.sidebar .nav-link:hover {
    background: rgba(255, 255, 255, 0.1);
}

.container-fluid {
    margin-left: 250px;
    padding-top: 20px;
}

.card {
    border: none;
    border-radius: 10px;
    transition: transform 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

.recommendation-item {
    border: 1px solid #ddd;
    border-radius: 10px;
    transition: box-shadow 0.3s;
}

.recommendation-item:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}