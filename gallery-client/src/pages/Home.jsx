import React, { useState, useEffect } from "react";
import Navbar from "../components/Navbar";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import getBaseURL from "../utils/baseURL";

const Home = () => {
  const [photos, setPhotos] = useState([]);
  const [searchQuery, setSearchQuery] = useState("");
  const navigate = useNavigate();

  const fetchPhotos = async () => {
    try {
      const response = await axios.get(`${getBaseURL}/getPhotos.php`);
      if (response.data.success) {
        setQuestions(response.data.questions);
      } else {
        console.error("Failed to fetch questions");
      }
    } catch (error) {
      console.error("Error fetching questions:", error);
    }
  };

  const handleLogout = () => {
    localStorage.removeItem("token");
    navigate("/login");
  };

  const filteredQuestions = questions.filter(
    (question) =>
      question.question.toLowerCase().includes(searchQuery.toLowerCase()) ||
      question.answer.toLowerCase().includes(searchQuery.toLowerCase())
  );

  useEffect(() => {
    fetchQuestions();
  }, []);

  return (
    <div>
      <Navbar />
      <div className="search-container">
        <input
          className="search-bar"
          type="text"
          placeholder="Search.."
          value={searchQuery}
          onChange={(e) => setSearchQuery(e.target.value)}
        />
        <a href="/question" className="plus-a">
          <button className="plus">+</button>
        </a>
      </div>

      <div id="question-cards" className="cards-container">
        {filteredQuestions.map((question) => (
          <div key={question.id} className="question-card">
            <h3>{question.question}</h3>
            <p>{question.answer}</p>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Home;
