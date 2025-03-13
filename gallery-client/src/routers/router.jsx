import React from "react";
import { createBrowserRouter } from "react-router-dom";
import App from "../App";
import Login from "../pages/Login";
import Signup from "../pages/Signup";

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
    ],
  },
]);

export default router;
