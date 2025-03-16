import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import getBaseURL from "../utils/baseURL";
import axios from "axios";

const Update = () => {
  const [form, setForm] = useState({
    user_id: "",
    title: "",
    description: "",
    tags: "",
    image_path: "",
  });

  const navigate = useNavigate();

  //to get user id
  const user_id = localStorage.getItem("user_id");
  form.user_id = user_id;

  const handleSubmit = async (e) => {
    e.preventDefault();
    console.log(form);
    try {
      const response = await axios.post(`${getBaseURL()}/updatePhoto.php`, form, {
        headers: {
          "Content-Type": "application/json",
        },
      });
      console.log(response.data);
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
        </form>
      </div>
    </div>
  );
};

export default Update;
