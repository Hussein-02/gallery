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
