import {useState, useEffect} from "react";
import UseFetch from "../../services/useFetch";
import {Button, Modal} from 'react-bootstrap';
import {useForm} from "react-hook-form";
import JSONPretty from 'react-json-pretty';
import "./menuitem.css";
import {useNavigate} from "react-router-dom";



const DeleteMenuItem = ({showModal, setShowModal, data, reload, setReload, setSubHeading}) => {
    const {error, isLoading, data: response, remove} = UseFetch();
    const [showButton, setShowButton] = useState(true)
    const navigate = useNavigate();

    const handleCancel = () => {
        setShowModal(false);
        setSubHeading("All Menu Items");
        navigate("/menuitems");
    }

    const handleDelete = () => {
        remove(data.id);
        setShowButton(false);
    }

    const handleClose = () => {
        setShowModal(false);
        setShowButton(true);
        setSubHeading("All Menu Items");
        setReload(!reload);
        navigate("/menuitems");
    }

    return (
        <Modal show={showModal} onHide={handleClose} centered animation={false} backdrop="static">
            <Modal.Header closeButton>
                <h4>Delete Menu Item</h4>
            </Modal.Header>
            <Modal.Body>
                {error && <JSONPretty data={error} style={{color: "red"}}></JSONPretty>}
                {isLoading &&
                    <div className="image-loading">
                        Please wait while data is being loaded
                        <img src={require(`../loading.gif`)} alt="Loading ......"/>
                    </div>
                }
                {response
                    ? <JSONPretty data={response}></JSONPretty>
                    : <div>
                        <span style={{color: "red"}}>Are you sure you want to delete the following item?</span>
                        <span><JSONPretty data={data} ></JSONPretty></span>
                    </div>
                }
            </Modal.Body>
            <Modal.Footer style={{justifyContent: "center"}}>
                <Button variant="danger" onClick={handleDelete}
                        style={{display: (!showButton) ? "none" : ""}}>Remove</Button>
                <Button variant="secondary" onClick={handleCancel}
                        style={{display: (!showButton) ? "none" : ""}}>Cancel</Button>
                <Button variant="primary" onClick={handleClose}
                        style={{display: (!showButton) ? "" : "none"}}>Close</Button>
            </Modal.Footer>
        </Modal>
    );
};

export default DeleteMenuItem;