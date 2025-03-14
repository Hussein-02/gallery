import React, { useState, useEffect } from "react";
import Navbar from "../components/Navbar";
import axios from "axios";
import getBaseURL from "../utils/baseURL";

const Home = () => {
  const [photos, setPhotos] = useState([]);
  const [searchQuery, setSearchQuery] = useState("");

  const fetchPhotos = async () => {
    try {
      const user_id = localStorage.getItem("user_id");

      const response = await axios.get(`${getBaseURL()}/getPhotos.php?user_id=${user_id}`);

      if (response.data.status) {
        setPhotos(response.data.photos);
      } else {
        console.error("Failed to fetch photos");
      }
    } catch (error) {
      console.error("Error fetching photos:", error);
    }
  };

  const filteredPhotos = photos.filter(
    (photo) =>
      photo.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
      photo.description.toLowerCase().includes(searchQuery.toLowerCase()) ||
      photo.tags.toLowerCase().includes(searchQuery.toLowerCase())
  );

  useEffect(() => {
    fetchPhotos();
  }, []);

  return (
    <div className="body">
      <Navbar />
      <div className="search-container">
        <input
          className="search-bar"
          type="text"
          placeholder="Search.."
          value={searchQuery}
          onChange={(e) => setSearchQuery(e.target.value)}
        />
        <a href="/photo" className="plus-a">
          <button className="plus">+</button>
        </a>
      </div>

      <div id="photo-cards" className="cards-container">
        {filteredPhotos.map((photo) => (
          <div key={photo.id} className="photo-card">
            <img src={photo.image_path} alt="" />
            <h3>{photo.title}</h3>
            <p>{photo.description}</p>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Home;
