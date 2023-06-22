import {useState, useEffect} from "react";
import UseFetch from "../../services/useFetch";
import {Button, Modal} from 'react-bootstrap';
import {useForm} from "react-hook-form";
import JSONPretty from 'react-json-pretty';
import "./menuitem.css";

const CreateMenuItem = ({showModal, setShowModal, reload, setReload, setSubHeading}) => {

    const {error, isLoading, data: response, create} = UseFetch();
    const [submitted, setSubmitted] = useState(false);
    const [showButton, setShowButton] = useState(true)

    const {register, handleSubmit, formState: {errors}} = useForm({
        defaultValues: {id: "", name: "", description: "", price: ""},
        shouldUseNativeValidation: false
    });

    const createFormOptions = {
        id: {required: "ID is required"},
        name: {required: "Name is required"},
        description: {required: "Description is required"},
        price: {required: "Price is required"}
    }

    const handleCreate = (menuitem) => {
        create(menuitem);
        setSubmitted(true);
    }

    useEffect(() => {
        if (!submitted || error != null) {
            setShowButton(true);
        } else {
            setShowButton(false);
        }
    })

    const handleCancel = () => {
        setShowModal(false);
        setSubHeading("All Menu Items");
    }

    const handleClose = () => {
        setShowModal(false);
        setShowButton(true);
        setSubmitted(false);
        setSubHeading("All Menu Items");
        setReload(!reload);
    }

    return (
        <Modal show={showModal} onHide={handleClose} centered animation={false} backdrop="static">
            <Modal.Header closeButton>
                <h4>Create Menu Item</h4>
            </Modal.Header>
            <Modal.Body>
                {error && <JSONPretty data={error} style={{color: "red"}}></JSONPretty>}
                {isLoading &&
                    <div className="image-loading">
                        Please wait while data is being loaded
                        <img src={require(`../loading.gif`)} alt="Loading ......"/>
                    </div>
                }
                {response && <JSONPretty data={response}></JSONPretty>}
                {(!submitted || error != null) &&
                    <form className="form-menuitem" id="form-menuitem-edit" onSubmit={handleSubmit(handleCreate)}>
                        <ul className="form-menuitem-errors">
                            {errors?.id && <li>{errors.id.message}</li>}
                            {errors?.name && <li>{errors.name.message}</li>}
                            {errors?.description && <li>{errors.email.message}</li>}
                            {errors?.price && <li>{errors.major.message}</li>}
                        </ul>
                        <div className="form-group">
                            <label>Item ID</label>
                            <input name="id" {...register('id', createFormOptions.id)}/>
                        </div>
                        <div className="form-group">
                            <label>Name</label>
                            <input type="text" name="name" {...register('name', createFormOptions.name)}/>
                        </div>
                        <div className="form-group">
                            <label>Email</label>
                            <input name="description" {...register('description', createFormOptions.description)}/>
                        </div>
                        <div className="form-group">
                            <label>Major</label>
                            <input name="price" {...register('price', createFormOptions.price)}/>
                        </div>
                    </form>
                }
            </Modal.Body>
            <Modal.Footer style={{justifyContent: "center"}}>
                <Button variant="primary" form="form-menuitem-edit" type="submit"
                        style={{display: (!showButton) ? "none" : ""}}>Create</Button>
                <Button variant="secondary" onClick={handleCancel}
                        style={{display: (!showButton) ? "none" : ""}}>Cancel</Button>
                <Button variant="primary" onClick={handleClose}
                        style={{display: (!showButton) ? "" : "none"}}>Close</Button>
            </Modal.Footer>
        </Modal>
    );
};

export default CreateMenuItem;
