import {settings} from "../../config/config";
import {useAuth} from "../../services/useAuth";
import useAxios from "../../services/useAxios";
import {NavLink, Outlet, useLocation} from "react-router-dom";
import {useState} from "react";
import "./ingredient.css";
import Ingredient from "./ingredient";
import Pagination from "./pagination";

const Ingredients = () => {
    const [url, setUrl] = useState(settings.baseApiUrl + "/ingredients");
    const {user} = useAuth();
    const [subHeading, setSubHeading] = useState("All Ingredients");
    const [showIngredient, setShowIngredient] = useState(false);
    const handleIngredientClick = () => setShowIngredient(true);

    //declare the data fetching function
    const {
        error,
        isLoading,
        data: ingredients
    } = useAxios(url, "GET", {Authorization: "Bearer " + user.jwt});

    return (
        <>
            {showIngredient && <Ingredient show={showIngredient} setShow={setShowIngredient}/>}
            <div className="main-heading">
                <div className="container">Ingredient</div>
            </div>
            <div className="sub-heading">
                <div className="container">All Ingredients</div>
            </div>
            <div className="main-content container">
                {/* {error && <div>{error}</div>} */}
                {isLoading &&
                    <div className="image-loading">
                        Please wait while data is being loaded
                        <img src={require(`../loading.gif`)} alt="Loading ......"/>
                    </div>
                }                
                {ingredients && <div className="ingredient-container">
                <div className="ingredient-list">
                    {ingredients.data.map((ingredient) => (
                        <NavLink key={ingredient.id}
                                 className={({isActive}) => isActive ? "active" : ""}
                                 to={`/ingredients/${ingredient.id}`}>
                            <span>&nbsp;</span><div>{ingredient.name}</div>
                        </NavLink>
                    ))}
                </div>
                <div className="ingredient">
                    <Outlet context={[subHeading, setSubHeading]}/>
                </div>
                    </div>}
                {/*{ingredients &&
                    <div className="ingredient-container">
                        <div className="ingredient-row ingredient-row-header">
                            <div>Number</div>
                            <div>Title</div>
                            <div>Credit Hours</div>
                            <div>Prerequisites</div>
                        </div>
                        {ingredients.data && ingredients.data.map((ingredient) => (
                            <div key={ingredient.number} className="ingredient-row">
                                <div>
                                    <NavLink
                                        className={({isActive}) => isActive ? "active" : ""}
                                        to={`/ingredients/${ingredient.number}`}
                                        onClick={handleIngredientClick}>
                                        {ingredient.number}
                                    </NavLink>
                                </div>
                                <div>{ingredient.title}</div>
                                <div>{ingredient.credit_hours}</div>
                                <div>{ingredient.prerequisites}</div>
                            </div>
                        ))}
                    </div>}
                {ingredients && <Pagination ingredients={ingredients} setUrl={setUrl}/>}*/}
            </div>
        </>
    );
};

export default Ingredients;
