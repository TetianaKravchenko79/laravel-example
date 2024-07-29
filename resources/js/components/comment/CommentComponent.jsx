import React from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import Swal from "sweetalert2";

class CommentDialog extends React.Component {
    constructor(props) {
        super(props);

        this.handleNewComment = this.handleNewComment.bind(this);
        this.addComment = this.addComment.bind(this);
        this.keyDown = this.keyDown.bind(this);
        this.removeComment = this.removeComment.bind(this);
        //...

        this.state = {
            user: window.user, //!!!
            product: window.product,
            comments: window.product.comments,
            newComment: "",
            rating: 0,
        };
    }

    componentDidMount() {
        //...
    }

    handleNewComment(event) {
        this.setState({
            newComment: event.target.value,
        });
    }

    handleRating(rating) {
        this.setState({
            rating: rating,
        });
    }

    addComment() {
        let self = this; //!!!self - becouse axios
        //   if (this.state.newComment) {
        axios
            .post("/addcomment", {
                id: this.state.product.id,
                comment: this.state.newComment,
                rating: this.state.rating,
            }) //!!!this.state.newComment
            .then(function (resp) {
                console.log(resp.data);

                self.handleComments(resp.data.comments); //!!!self - becouse axios

                self.setState({
                    //!!!self - becouse axios
                    newComment: "", //!!!reset textarea
                    rating: 0,
                });
            })
            .catch(function (resp) {
                console.log(resp.response);
                //alert("Could not add comment");
                //alert(resp.response.data.message);

                let errors = resp.response.data.errors; //!!!check from console browser
                let titleErrors = "";
                for (let i in errors) {
                    titleErrors += i + " - " + errors[i];
                }
                Swal.fire({
                    icon: "error",
                    text: titleErrors,
                });
            });
        //   } else {
        //       Swal.fire({
        //           icon: "error",
        //           text: "Field New Comment must be filled in!",
        //       });
        //   }
    }

    keyDown(event) {
        if (event.keyCode === 13) {
            this.addComment();
            event.preventDefault();
        }
    }
    /*removeComment(commentId) {
        let self = this; //!!!self - becouse axios

        axios
            .post("/removecomment", {
                id: this.state.product.id,
                commentId: commentId,
            }) //!!!this.state.newComment
            .then(function (resp) {
                console.log(resp.data);

                self.handleComments(resp.data.comments); //!!!self - becouse axios
            })
            .catch(function (resp) {
                console.log(resp.response);

                let errors = resp.response.data.errors; //!!!check from console browser
                let titleErrors = "";
                for (let i in errors) {
                    titleErrors += i + " - " + errors[i];
                }
                Swal.fire({
                    icon: "error",
                    text: titleErrors,
                });
            });
    }*/

    removeComment(event) {
        let commentId = event.currentTarget.value;
        let self = this; //!!!self - becouse axios

        axios
            .post("/removecomment", {
                id: this.state.product.id,
                commentId: commentId,
            }) //!!!this.state.newComment
            .then(function (resp) {
                console.log(resp.data);

                self.handleComments(resp.data.comments); //!!!self - becouse axios
            })
            .catch(function (resp) {
                console.log(resp.response);

                Swal.fire({
                    icon: "error",
                    text:
                        resp.response.status +
                        " " +
                        resp.response.statusText +
                        " " +
                        resp.response.data.message,
                });
            });
    }
    handleComments(comments) {
        this.setState({
            comments: comments,
        });
    }
    render() {
        return (
            <div>
                <hr />
                <h4>Add New Comment</h4>
                <div className="comment_items">
                    <div className="row m-2">
                        <div className="col-xl-6">
                            <textarea
                                className="w-100 p-2"
                                rows="3"
                                value={this.state.newComment}
                                placeholder="New Comment"
                                onChange={this.handleNewComment}
                                onKeyDown={this.keyDown}
                            ></textarea>
                        </div>

                        <div className="col-xl-6">
                            <div className="form-check">
                                <input
                                    className="form-check-input"
                                    name="rating"
                                    type="radio"
                                    value="1"
                                    checked={this.state.rating === "1"}
                                    onChange={() => this.handleRating("1")}
                                />
                                <div className="rating_r rating_r_1 product_rating">
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                </div>
                            </div>
                            <div className="form-check">
                                <input
                                    className="form-check-input"
                                    name="rating"
                                    type="radio"
                                    value="2"
                                    checked={this.state.rating === "2"}
                                    onChange={() => this.handleRating("2")}
                                />
                                <div className="rating_r rating_r_2 product_rating">
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                </div>
                            </div>
                            <div className="form-check">
                                <input
                                    className="form-check-input"
                                    name="rating"
                                    type="radio"
                                    value="3"
                                    checked={this.state.rating === "3"}
                                    onChange={() => this.handleRating("3")}
                                />
                                <div className="rating_r rating_r_3 product_rating">
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                </div>
                            </div>
                            <div className="form-check">
                                <input
                                    className="form-check-input"
                                    name="rating"
                                    type="radio"
                                    value="4"
                                    checked={this.state.rating === "4"}
                                    onChange={() => this.handleRating("4")}
                                />
                                <div className="rating_r rating_r_4 product_rating">
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                </div>
                            </div>
                            <div className="form-check">
                                <input
                                    className="form-check-input"
                                    name="rating"
                                    type="radio"
                                    value="5"
                                    checked={this.state.rating === "5"}
                                    onChange={() => this.handleRating("5")}
                                />
                                <div className="rating_r rating_r_5 product_rating">
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="row m-2">
                        <div className="col-xl-6">
                            <button
                                className="btn btn-info"
                                onClick={this.addComment}
                            >
                                add comment
                            </button>
                        </div>
                    </div>
                </div>
                <hr />
                <h4>Comment's List</h4>
                <div className="comment_items">
                    <ul className="comment_items_list">
                        {this.state.comments.map((comment, key) => (
                            <li key={key}>
                                <div className="row m-2">
                                    <div className="col-xl-1 border text-center p-2">
                                        {(this.state.user.role === "admin" ||
                                            comment.user_id ===
                                                this.state.user.id) && (
                                            <div>
                                                {/*} <button
                                                className="btn btn-light"
                                                value={comment.id}
                                                onClick={() => {
                                                    this.removeComment(
                                                        comment.id
                                                    );
                                                }}
                                            >*/}
                                                <button
                                                    className="btn btn-light"
                                                    value={comment.id}
                                                    onClick={this.removeComment}
                                                >
                                                    <i
                                                        className="fa fa-trash-o"
                                                        aria-hidden="true"
                                                    ></i>
                                                </button>
                                            </div>
                                        )}
                                    </div>
                                    <div className="col-xl-3 border text-center p-2">
                                        {comment.comment}
                                    </div>
                                    <div className="col-xl-2 border text-center p-2">
                                        {comment.created_at}
                                    </div>
                                    <div className="col-xl-3 border text-center p-2">
                                        {comment.user.name}
                                    </div>

                                    <div className="col-xl-3 border text-center p-2">
                                        <div
                                            className={
                                                "rating_r rating_r_" +
                                                comment.rating +
                                                " product_rating"
                                            }
                                        >
                                            <i></i>
                                            <i></i>
                                            <i></i>
                                            <i></i>
                                            <i></i>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        ))}
                    </ul>
                </div>
            </div>
        );
    }
}

const elem = document.querySelector(".comment_block");

if (elem) {
    ReactDOM.render(<CommentDialog />, elem);
}
