import {settings} from "../../config/config";
import useXmlHttp from '../../services/useXmlHttp';
import {useParams, Link, Outlet, useOutletContext} from "react-router-dom";
import './ingredient.css';
import {useAuth} from "../../services/useAuth";

const Ingredient = () => {
    const {user} = useAuth();
    const [subHeading, setSubHeading] = useOutletContext();
    const ingredientId = window.location.toString().split("ingredients/")[1];
    const url = settings.baseApiUrl + "/ingredients/" + ingredientId;
    console.log(url);
    const {
        error,
        isLoading,
        data: ingredient
    } = useXmlHttp(url, "GET", {Authorization:`Bearer ${user.jwt}`});

    return (
        <>
            {/* {error && <div>{error}</div>} */}
            {isLoading &&
                <div className="image-loading">
                    Please wait while data is being loaded
                    <img src={require(`../loading.gif`)} alt="Loading ......"/>
                </div>}
            {ingredient && 
            <>
                {setSubHeading(ingredient.name)}
                <div className="ingredient-details">
                    {/* <div className="Ingredient-name">{Ingredient.name}</div>*/}
                    <div className="ingredient-info">
                        <div><strong>ID</strong>: {ingredient.ingredientID}</div>
                        <div><strong>Item Name</strong>: {ingredient.name}</div>
                        <div><strong>Description</strong>: {ingredient.description}</div>
                        <div><strong>Price</strong>: {ingredient.price}</div>
                        {/* <div><strong>Ingredients</strong>:
                            <Link to={`Ingredientingredients/${Ingredient.itemID}`}> Click here to view ingredients</Link>
                        </div> */}
                    </div>
                    {/* <div className="Ingredient-photo">
                        <img src={Ingredient.image} alt={Ingredient.name} id={Ingredient.itemID}/>
                    </div> */}
                </div>
                <div className="ingredient-classes">
                    <Outlet/>
                </div>
            </>}
        </>
    );
};

export default Ingredient;
