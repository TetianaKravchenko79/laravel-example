import React from "react";
import axios from "axios";
import { store } from "../reducer";

export default class ClearDialog extends React.Component {
    constructor(props) {
        super(props);

        this.clearCart = this.clearCart.bind(this);

        this.state = {
            //...
        };
    }

    componentDidMount() {
        //...
    }

    clearCart(event) {
        event.preventDefault();
        let self = this; //!!!self - becouse axios
        axios
            .post("/clearall", { carts: this.props.carts })
            .then(function (resp) {
                console.log(resp.data);

                self.handleCart(resp.data); //!!!self - becouse axios
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Could not delete cart");
            });
    }

    handleCart(carts) {
        // this.props.handleCart(carts);
        store.dispatch({ type: "CHANGE_STATE_CARTS", cartsAfterRemove: carts });
    }

    render() {
        return (
            <div className="cart_buttons d-flex flex-row align-items-start justify-content-start">
                <div className="cart_buttons_inner ml-sm-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                    <div
                        className="button button_clear trans_200"
                        onClick={this.clearCart}
                    >
                        <a href="#">clear</a>
                    </div>
                </div>
            </div>
        );
    }
}
