import {settings} from "../../config/config";
import {useAuth} from "../../services/useAuth";
import useAxios from "../../services/useAxios";
import {useParams, useNavigate} from "react-router-dom";
import {Modal, Button} from 'react-bootstrap';
import "./ingredient.css";

const Ingredient = ({show, setShow}) => {
    const {ingredientNum} = useParams();
    const url = settings.baseApiUrl + "/ingredients/" + ingredientNum;
    const {user} = useAuth();
    const navigate = useNavigate();
    const handleClose = () => {setShow(false); navigate("/ingredients")};

    //fetch ingredient data using the useAxios hook
    const {
        error,
        isLoading,
        data: ingredient
    } = useAxios(url, "GET", {Authorization: "Bearer " + user.jwt});

    return (
        <>
            <Modal show={show} onHide={handleClose} centered size="lg">
                <Modal.Header closeButton>
                    <h4>{ingredient && ingredient.title}</h4>
                </Modal.Header>
                <Modal.Body>
                    {error && <div>{error}</div>}
                    {isLoading &&
                        <div className="image-loading">
                            Please wait while data is being loaded
                            <img src={require(`../loading.gif`)} alt="Loading ......"/>
                        </div>
                    }
                    {ingredient &&
                        <div className="ingredient-detail-container">
                            <div className="ingredient-detail-row">
                                <div>Number</div><div>{ingredient.number}</div>
                            </div>
                            <div className="ingredient-detail-row">
                                <div>Title</div><div>{ingredient.title}</div>
                            </div>
                            <div className="ingredient-detail-row">
                                <div>Credit Hours</div><div>{ingredient.credit_hours}</div>
                            </div>
                            <div className="ingredient-detail-row">
                                <div>Prerequisites</div><div>{ingredient.prerequisites}</div>
                            </div>
                            <div className="ingredient-detail-row">
                                <div>Description</div><div>{ingredient.description}</div>
                            </div>
                        </div>
                    }
                </Modal.Body>
                <Modal.Footer style={{borderTop: "none"}}>
                    <Button variant="secondary" onClick={handleClose}>Close</Button>
                </Modal.Footer>
            </Modal>
        </>
    );
};

export default Ingredient;
