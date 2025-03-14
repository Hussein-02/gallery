import React from "react";
import { createBrowserRouter } from "react-router-dom";
import App from "../App";
import Login from "../pages/Login";
import Signup from "../pages/Signup";
import Home from "../pages/Home";
import Photo from "../pages/Photo";

const router = createBrowserRouter([
  {
    path: "/",
    element: <App />, // Main layout component
    children: [
      {
        path: "/", // Login route for '/'
        element: <Login />,
      },
      {
        path: "/signup", // Login route for '/'
        element: <Signup />,
      },
      {
        path: "/home", // Login route for '/'
        element: <Home />,
      },
      {
        path: "/photo", // Login route for '/'
        element: <Photo />,
      },
    ],
  },
]);

export default router;
