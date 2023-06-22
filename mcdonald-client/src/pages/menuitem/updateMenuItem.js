import {useState, useEffect} from "react";
import UseFetch from "../../services/useFetch";
import {Button, Modal} from 'react-bootstrap';
import {useForm} from "react-hook-form";
import JSONPretty from 'react-json-pretty';
import "./menuitem.css";
import {useNavigate} from "react-router-dom";

const UpdateMenuItem = ({showModal, setShowModal, data, reload, setReload, setSubHeading}) => {
    const {error, isLoading, data: response, update} = UseFetch();
    const navigate = useNavigate();
    const [submitted, setSubmitted] = useState(false);
    const [showButton, setShowButton] = useState(true);

    const {register, handleSubmit, formState: {errors}} = useForm({
        defaultValues: data,
        shouldUseNativeValidation: false
    });
    const editFormOptions = {
        id: {required: "ID is required"},
        name: {required: "Name is required"},
        description: {required: "Description is required"},
        price: {required: "Price is required"}
    }

    const handleUpdate = (menuitem) => {
        update(menuitem);
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
        navigate("/menuitems")
    }

    const handleClose = () => {
        setShowModal(false);
        setShowButton(true);
        setSubmitted(false);
        setReload(!reload);
        setSubHeading("All Menu Items");
        navigate("/menuitems")
    }

    return (
        <Modal show={showModal} onHide={handleClose} centered animation={false} backdrop="static">
            <Modal.Header closeButton>
                <h4>Edit Item</h4>
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
                    <form className="form-menuitem" id="form-menuitem-edit" onSubmit={handleSubmit(handleUpdate)}>
                        <ul className="form-menuitem-errors">
                            {errors?.id && <li>{errors.id.message}</li>}
                            {errors?.name && <li>{errors.name.message}</li>}
                            {errors?.description && <li>{errors.description.message}</li>}
                            {errors?.price && <li>{errors.price.message}</li>}

                        </ul>
                        <div className="form-group">
                            <label>Student ID</label>
                            <input name="id" readOnly="readOnly" {...register('id', editFormOptions.id)}/>
                        </div>
                        <div className="form-group">
                            <label>Name</label>
                            <input type="text" name="name" {...register('name', editFormOptions.name)}/>
                        </div>
                        <div className="form-group">
                            <label>Email</label>
                            <input name="description" {...register('description', editFormOptions.description)}/>
                        </div>
                        <div className="form-group">
                            <label>Major</label>
                            <input name="price" {...register('major', editFormOptions.price)}/>
                        </div>

                    </form>}
            </Modal.Body>
            <Modal.Footer style={{justifyContent: "center"}}>
                <Button type="submit" form="form-menuitem-edit" variant="primary"
                        style={{display: (!showButton) ? "none" : ""}}>Update</Button>
                <Button variant="secondary" onClick={handleCancel}
                        style={{display: (!showButton) ? "none" : ""}}>Cancel</Button>
                <Button variant="primary" onClick={handleClose}
                        style={{display: (!showButton) ? "" : "none"}}>Close</Button>
            </Modal.Footer>
        </Modal>
    );
};

export default UpdateMenuItem;





















    // const {error, isLoading, data: response, create} = UseFetch();
    // const [submitted, setSubmitted] = useState(false);
    // const [showButton, setShowButton] = useState(true)

    // const {register, handleSubmit, formState: {errors}} = useForm({
    //     defaultValues: {id: "", name: "", email: "", major: "", gpa: ""},
    //     shouldUseNativeValidation: false
    // });

    // const createFormOptions = {
    //     id: {required: "ID is required"},
    //     name: {required: "Name is required"},
    //     email: {required: "Email is required"},
    //     major: {required: "Major is required"},
    //     gpa: {required: "GPA is required"}
    // }

    // const handleCreate = (student) => {
    //     create(student);
    //     setSubmitted(true);
    // }

    // useEffect(() => {
    //     if (!submitted || error != null) {
    //         setShowButton(true);
    //     } else {
    //         setShowButton(false);
    //     }
    // })

    // const handleCancel = () => {
    //     setShowModal(false);
    //     setSubHeading("All Students");
    // }

    // const handleClose = () => {
    //     setShowModal(false);
    //     setShowButton(true);
    //     setSubmitted(false);
    //     setSubHeading("All Students");
    //     setReload(!reload);
    // }