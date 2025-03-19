

<!DOCTYPE html>
<html>
<head>
<style>
  .sidebar {
    width: 250px;
    height: 100vh;
    background: white;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    padding: 20px 0;
    position: fixed;
    left: 0;
    top: 0;
  }

  .nav-item {
    display: flex;
    align-items: center;
    padding: 12px 24px;
    color: #333;
    text-decoration: none;
    transition: all 0.3s;
    margin: 4px 0;
  }

  .nav-item:hover {
    background: #f0f7ff;
    color: #0066ff;
  }

  .nav-item.active {
    background: #e6f0ff;
    color: #0066ff;
  }

  .nav-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    margin-right: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .home-icon {
    background: #00b3ff;
    color: white;
  }

  .profile-icon {
    background: #f0f0f0;
    overflow: hidden;
  }

  .profile-icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .create-icon {
    background: #0066ff;
    color: white;
  }

  .nav-text {
    font-weight: 500;
    font-size: 15px;
  }

  @media (max-width: 768px) {
    .sidebar {
      width: 100%;
      height: auto;
      bottom: 0;
      top: auto;
      padding: 10px;
    }

    .nav-item {
      padding: 8px 16px;
    }
  }
</style>
</head>
<body>
  <nav class="sidebar">
    <a href="#" class="nav-item active">
      <div class="nav-icon home-icon">🏠</div>
      <span class="nav-text">Home</span>
    </a>

    <a href="#" class="nav-item">
      <div class="nav-icon profile-icon">
        <img src="/api/placeholder/32/32" alt="Profile">
      </div>
      <span class="nav-text">Profile</span>
    </a>

    <a href="#" class="nav-item">
      <div class="nav-icon create-icon">➕</div>
      <span class="nav-text">Create</span>
    </a>
  </nav>
</body>
</html>