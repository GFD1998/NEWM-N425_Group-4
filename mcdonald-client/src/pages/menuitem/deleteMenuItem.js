import {useState, useEffect} from "react";
import UseFetch from "../../services/useFetch";
import {Button, Modal} from 'react-bootstrap';
import {useForm} from "react-hook-form";
import JSONPretty from 'react-json-pretty';
import "./menuitem.css";

const DeleteMenuItem = () => {

    return (
        <>
            <h2 className="crud-form-title">Delete Menu Item</h2>
            <form className="crud-form">
                <input type="number" placeholder="ID"></input>
                <input type="text" placeholder="Name"></input>
                <input type="text" placeholder="Description"></input>
                <input type="number" step="0.01" placeholder="Price"></input>
                <button type="submit">Submit Request</button>
            </form>
        </>
    );
};

export default DeleteMenuItem;





















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