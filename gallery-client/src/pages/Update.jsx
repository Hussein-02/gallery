import React, { useEffect, useState } from "react";
import getBaseURL from "../utils/baseURL";
import axios from "axios";
import { useLocation, useNavigate } from "react-router-dom";

const Update = () => {
  const navigate = useNavigate();
  const location = useLocation();
  const photo = location.state?.photo || {};

  const [form, setForm] = useState({
    photo_id: photo.id,
    title: photo.title,
    description: photo.description,
    tags: photo.tags,
    image_path: "",
  });

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post(`${getBaseURL()}/updatePhoto.php`, form, {
        headers: {
          "Content-Type": "application/json",
        },
      });
      if (response.data.status) {
        navigate("/home");
      }
    } catch (error) {
      console.error("There was an error!", error);
    }
  };

  //to get image from form
  const handleImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => {
        setForm({
          ...form,
          image_path: reader.result,
        });
      };
    }
  };

  const handleDelete = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.delete(`${getBaseURL()}/deletePhoto.php`, {
        data: { photo_id: form.photo_id },
        headers: {
          "Content-Type": "application/json",
        },
      });
      if (response.data.status) {
        navigate("/home");
      }
    } catch (error) {
      console.error("There was an error!", error);
    }
  };

  useEffect(() => {
    const token = localStorage.getItem("token");
    if (!token) {
      navigate("/");
    }
  }, []);

  return (
    <div className="body">
      <h1 className="logo">GALLERY</h1>
      <div className="photo-section">
        <h1>Edit Photo</h1>
        <form className="login-form" id="signupForm" onSubmit={handleSubmit}>
          <div className="login-input">
            <label htmlFor="title">Title</label>
            <input
              type="text"
              id="title"
              name="title"
              value={form.title}
              onChange={(e) => {
                setForm({
                  ...form,
                  title: e.target.value,
                });
              }}
            />
          </div>

          <div className="login-input">
            <label htmlFor="description">Description</label>
            <input
              type="text"
              id="description"
              name="description"
              value={form.description}
              onChange={(e) => {
                setForm({
                  ...form,
                  description: e.target.value,
                });
              }}
            />
          </div>

          <div className="login-input">
            <label htmlFor="tags">Tags</label>
            <input
              type="text"
              id="tags"
              name="tags"
              value={form.tags}
              onChange={(e) => {
                setForm({
                  ...form,
                  tags: e.target.value,
                });
              }}
            />
          </div>
          <div className="file-input">
            <label htmlFor="image_path" className="custom-file-upload">
              Upload Image
            </label>

            <input id="image_path" type="file" onChange={handleImageChange} />
            {form.image_path && <p className="img-result">Image uploaded</p>}
          </div>

          <input type="submit" value="Submit" />
          <button className="signup-btn" onClick={handleDelete}>
            Delete Photo
          </button>
        </form>
      </div>
    </div>
  );
};

export default Update;
