const router = createBrowserRouter([
  {
    path: "/",
    element: <App />, // Main layout component
    children: [
      {
        path: "/", // Home route for '/'
        element: <Home />,
      },
    ],
  },
]);
