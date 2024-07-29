import React from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import Swal from "sweetalert2";

class LayoutDialog extends React.Component {
    constructor(props) {
        super(props);

        this.handleMessage = this.handleMessage.bind(this);
        this.handleContact = this.handleContact.bind(this);
        this.clickMailer = this.clickMailer.bind(this);

        this.state = {
            message: "",
            contact: "",
        };
    }

    handleMessage(event) {
        this.setState({
            message: event.target.value,
        });
    }

    handleContact(event) {
        this.setState({
            contact: event.target.value,
        });
    }

    clickMailer() {
        let self = this; //!!!self - becouse axios
        axios
            .post("/mailer", {
                message: this.state.message,
                contact: this.state.contact,
            })
            .then(function (resp) {
                console.log(resp.data);

                if (resp.data.mail) {
                    Swal.fire({
                        title: "Сongratulations!",
                        text: "Your message has been sending successfully!",
                        icon: "success",
                    });

                    self.setState({
                        message: "",
                        contact: "",
                    });
                } else {
                    Swal.fire({
                        title: "Oops!",
                        text: "There is any mistake!",
                        icon: "error",
                    });
                }
            })
            .catch(function (resp) {
                console.log(resp);
                if (resp.response) {
                    //!!!back-error
                    console.log(resp.response.data); //...message, ...file, ...line
                }
                alert("Could not delete cart");
            });
    }

    componentDidMount() {
        //...
    }

    render() {
        return (
            <div>
                <input
                    type="text"
                    name="newsletter_input_message"
                    value={this.state.message}
                    className="newsletter_input message"
                    placeholder="Ваше сообщение"
                    onChange={this.handleMessage}
                />
                <input
                    type="text"
                    name="newsletter_input_email"
                    value={this.state.contact}
                    className="newsletter_input email"
                    placeholder="Ваш контакт(email, skype,...)"
                    onChange={this.handleContact}
                />
                <br />
                <button
                    type="button"
                    className="newsletter_button"
                    onClick={this.clickMailer}
                >
                    {">"}
                </button>
                <br></br>
            </div>
        );
    }
}

const elem = document.querySelector(".newsletter");

if (elem) {
    ReactDOM.render(<LayoutDialog />, elem);
}
