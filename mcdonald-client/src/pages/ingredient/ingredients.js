import {settings} from "../../config/config";
import {NavLink, Outlet, useLocation} from "react-router-dom";
import {useState, useEffect} from "react";
import "../styles/menu.module.css";
import './ingredient.css';
import useXmlHttp from "../../services/useXmlHttp";
import {useAuth} from "../../services/useAuth";

const Ingredients = () => {
    const {user} = useAuth();
    const {pathname} = useLocation();
    const [subHeading, setSubHeading] = useState("All Ingredients");
    const url = settings.baseApiUrl + "/ingredients";
    console.log(url);

    const {
        error,
        isLoading,
        data: ingredients
    } = useXmlHttp(url, "GET", {Authorization:`Bearer ${user.jwt}`});

    useEffect(() => {
        setSubHeading("All Ingredients");
    }, [pathname]);

    return (
        <>
            <div className="main-heading">
                <div className="container">Ingredients</div>
            </div>
            <div className="sub-heading">
                <div className="container">{subHeading}</div>
            </div>
            <div className="main-content container">
                {/* {error && <div>{error}</div>} */}
                {isLoading &&
                    <div className="image-loading">
                        Please wait while data is being loaded
                        <img src={require(`../loading.gif`)} alt="Loading ......"/>
                </div>}
                {ingredients && <div className="ingredient-container">
                    <div className="ingredient-list">
                    {console.log(ingredients.data)}
                        {ingredients.data.map((ingredient) => (
                            
                            <NavLink key={ingredient.ingredientID}
                                     className={({isActive}) => isActive ? "active" : ""}
                                     to={`/ingredients/${ingredient.ingredientID}`}>
                                <span>&nbsp;</span><div>{ingredient.name}</div>
                            </NavLink>
                        ))}
                    </div>
                    <div className="ingredient">
                        <Outlet context={[subHeading, setSubHeading]}/>
                    </div>
                        </div>}
            </div>
        </>
    );
};

export default Ingredients;
