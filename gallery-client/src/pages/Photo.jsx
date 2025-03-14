import React from "react";

const Photo = () => {
  return (
    <div className="body">
      <h1 className="logo">GALLERY</h1>
      <div className="photo-section">
        <h1>Add Photo</h1>
        <form
          className="login-form"
          id="signupForm"
          // onSubmit={handleSubmit}
        >
          <div className="login-input">
            <label htmlFor="title">Title</label>
            <input
              type="text"
              id="title"
              name="title"
              // value={title}
              // onChange={(e) => {
              //   setForm({
              //     ...form,
              //     title: e.target.value,
              //   });
              // }}
            />
          </div>

          <div className="login-input">
            <label htmlFor="description">Description</label>
            <input
              type="text"
              id="description"
              name="description"
              // value={description}
              // onChange={(e) => {
              //   setForm({
              //     ...form,
              //     description: e.target.value,
              //   });
              // }}
            />
          </div>

          <div className="login-input">
            <label htmlFor="tags">Tags</label>
            <input
              type="text"
              id="tags"
              name="tags"
              // value={tags}
              // onChange={(e) => {
              //   setForm({
              //     ...form,
              //     tags: e.target.value,
              //   });
              // }}
            />
          </div>
          <div className="file-input">
            <label htmlFor="file-upload" className="custom-file-upload">
              Upload Image
            </label>

            <input id="file-upload" type="file" />
          </div>

          <input type="submit" value="Submit" />
        </form>
      </div>
    </div>
  );
};

export default Photo;
