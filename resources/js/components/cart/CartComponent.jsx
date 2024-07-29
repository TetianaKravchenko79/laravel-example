import React from "react";
import ReactDOM from "react-dom";
// import axios from "axios";
import RemoveDialog from "./RemoveComponent";
import ClearDialog from "./ClearComponent";

import { store } from "../reducer";
import { cartNativeJsObj } from "../cartNative";

class CartDialog extends React.Component {
    constructor(props) {
        super(props);
        this.handleCart = this.handleCart.bind(this);
        // this.clearCart = this.clearCart.bind(this);
        this.state = {
            carts: window.carts,
        };
    }

    componentDidMount() {
        console.log(this.state.carts);

        store.subscribe(() => this.handleStore(store.getState()));
    }

    handleStore(stories) {
        this.handleCart(stories.cartsReducer);
    }

    // clearCart(event) {
    //     event.preventDefault();
    //     let self = this; //!!!self - becouse axios
    //     axios
    //         .post("/clearall", {})
    //         .then(function (resp) {
    //             console.log(resp.data);

    //             self.handleCart(resp.data); //!!!self - becouse axios
    //         })
    //         .catch(function (resp) {
    //             console.log(resp);
    //             alert("Could not delete cart");
    //         });
    // }

    handleCart(carts) {
        this.setState({
            carts: carts,
        });
        // document.querySelector("#lblCartCount").innerText = carts.length;
        cartNativeJsObj.selector = "#lblCartCount";

        cartNativeJsObj.changeValueSelector(carts.length);
    }

    render() {
        return (
            <div>
                <div className="cart_items">
                    <ul className="cart_items_list">
                        {this.state.carts.map((item, key) => (
                            <li
                                key={key}
                                className="cart_item item_list d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-end justify-content-start"
                                style={{ width: "50%" }}
                            >
                                <div className="product d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start mr-auto">
                                    <RemoveDialog
                                        cartId={item.id}
                                        productId={item.product.id}
                                        sizeId={item.size.id}
                                        handleCart={this.handleCart}
                                    />
                                    <div>
                                        <div className="product_image">
                                            <img
                                                src={
                                                    "/images/" +
                                                    item.product.image
                                                }
                                                alt=""
                                            />
                                        </div>
                                    </div>
                                    <div className="product_name_container">
                                        <div className="product_name">
                                            <a
                                                href={
                                                    "/product/" +
                                                    item.product.id
                                                }
                                            >
                                                {item.product.name}
                                            </a>
                                        </div>
                                        <div className="product_text">
                                            Second line for additional info
                                        </div>
                                    </div>
                                </div>
                                <div className="product_price product_text">
                                    {item.product.price}
                                </div>
                                <div className="product_size product_text">
                                    {item.size.name}
                                </div>
                            </li>
                        ))}
                    </ul>
                </div>
                <ClearDialog
                    carts={this.state.carts}
                    handleCart={this.handleCart}
                />
            </div>
        );
    }
}

const elem = document.querySelector(".cart_block");

if (elem) {
    ReactDOM.render(<CartDialog />, elem);
}
