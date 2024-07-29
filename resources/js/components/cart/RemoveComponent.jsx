import React from "react";
import axios from "axios";
import { store } from "../reducer";

export default class RemoveDialog extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            //...
        };
    }

    componentDidMount() {
        //...
    }

    removeCart(id, productId, sizeId) {
        let self = this; //!!!self - becouse axios
        axios
            .post("/clearone", {
                id: id,
                product_id: productId,
                size_id: sizeId,
            })
            .then(function (resp) {
                console.log(resp.data);

                self.handleCart(resp.data); //!!!self - becouse axios
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

    handleCart(carts) {
        // this.setState({
        //     carts: carts,
        // });
        // this.props.handleCart(carts);
        store.dispatch({ type: "CHANGE_STATE_CARTS", cartsAfterRemove: carts });
    }

    render() {
        return (
            <div>
                <a
                    className="btn btn-danger listbuttonremove"
                    href="#"
                    onClick={(e) => {
                        this.removeCart(
                            this.props.cartId,
                            this.props.productId,
                            this.props.sizeId
                        );
                        e.preventDefault();
                    }}
                >
                    <i className="fa fa-trash-o" aria-hidden="true"></i>
                </a>
            </div>
        );
    }
}
