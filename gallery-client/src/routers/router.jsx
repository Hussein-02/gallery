import React from "react";
import { createBrowserRouter } from "react-router-dom";
import App from "../App";
import Login from "../pages/Login";

const router = createBrowserRouter([
  {
    path: "/",
    element: <App />, // Main layout component
    children: [
      {
        path: "/", // Login route for '/'
        element: <Login />,
      },
    ],
  },
]);

export default router;
