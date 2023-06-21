import {settings} from "../../config/config";
import {NavLink, Outlet, useLocation} from "react-router-dom";
import {useState, useEffect} from "react";
import "../styles/menu.module.css";
import './allergen.css';
import useXmlHttp from "../../services/useXmlHttp";
import {useAuth} from "../../services/useAuth";

const Allergens = () => {
    const {user} = useAuth();
    const {pathname} = useLocation();
    const [subHeading, setSubHeading] = useState("All Allergens");
    const url = settings.baseApiUrl + "/allergens";
    console.log(url);

    const {
        error,
        isLoading,
        data: allergens
    } = useXmlHttp(url, "GET", {Authorization:`Bearer ${user.jwt}`});

    useEffect(() => {
        setSubHeading("All Allergens");
    }, [pathname]);

    return (
        <>
            <div className="main-heading">
                <div className="container">Allergens</div>
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
                {allergens && <div className="allergen-container">
                    <div className="allergen-list">
                    {console.log(allergens.data)}
                        {allergens.data.map((allergen) => (
                            
                            <NavLink key={allergen.allergenID}
                                     className={({isActive}) => isActive ? "active" : ""}
                                     to={`/allergens/${allergen.allergenID}`}>
                                <span>&nbsp;</span><div>{allergen.name}</div>
                            </NavLink>
                        ))}
                    </div>
                    <div className="allergen">
                        <Outlet context={[subHeading, setSubHeading]}/>
                    </div>
                        </div>}
            </div>
        </>
    );
};

export default Allergens;
