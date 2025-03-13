import React, { useState } from "react";
import axios from "axios";
import "../css/styles.css";
import { useNavigate } from "react-router-dom";
import getBaseURL from "../utils/baseURL";

const Login = () => {
  // const [email, setEmail] = useState("");
  // const [password, setPassword] = useState("");
  const [form, setForm] = useState({
    email: "",
    password: "",
  });

  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post(`${getBaseURL()}/login.php`, form, {
        headers: {
          "Content-Type": "application/json",
        },
      });

      if (response.data.success) {
        const token = response.data.token;
        localStorage.setItem("token", token);

        navigate("/home");
      }
    } catch (error) {
      console.error("There was an error!", error);
    }
  };

  return (
    <div className="body">
      <h1 className="logo">GALLERY</h1>
      <div className="login-section">
        <h1>Log In</h1>
        <form className="login-form" id="loginForm" onSubmit={handleSubmit}>
          <div className="login-input">
            <label htmlFor="email">Email</label>
            <input
              type="text"
              id="email"
              name="email"
              // value={email}
              onChange={(e) => {
                setForm({
                  ...form,
                  email: e.target.value,
                });
              }}
            />
          </div>

          <div className="login-input">
            <label htmlFor="password">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              // value={password}
              onChange={(e) => {
                setForm({
                  ...form,
                  password: e.target.value,
                });
              }}
            />
          </div>

          <input type="submit" value="Log In" className="login-btn" />
        </form>
        <a href="./signup.html">
          <button className="signup-btn">Sign Up</button>
        </a>
      </div>
    </div>
  );
};

export default Login;
