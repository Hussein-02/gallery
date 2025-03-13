import React from "react";
import "./Navbar.css";
import userIcon from "./assets/icons/user.png";
import { useNavigate } from "react-router-dom";

const Navbar = () => {
  const navigate = useNavigate();
  const handleLogout = () => {
    localStorage.removeItem("token");
    navigate("/login");
  };

  return (
    <nav className="flex navbar">
      <h1 className="logo">ARTICLE</h1>
      <div>
        <div className="flex center">
          <div className="dropdown">
            <img src={userIcon} alt="User" className="navbar-img" />
            <div className="dropdown-content">
              <a href="#" id="logout" onClick={handleLogout}>
                Log Out
              </a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
