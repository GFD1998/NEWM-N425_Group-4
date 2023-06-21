import {settings} from "../../config/config";
import useXmlHttp from '../../services/useXmlHttp';
import {useParams, Link, Outlet, useOutletContext} from "react-router-dom";
import './allergen.css';
import {useAuth} from "../../services/useAuth";

const Allergen = () => {
    const {user} = useAuth();
    const [subHeading, setSubHeading] = useOutletContext();
    const allergenId = window.location.toString().split("allergens/")[1];
    const url = settings.baseApiUrl + "/allergens/" + allergenId;
    console.log(url);
    const {
        error,
        isLoading,
        data: allergen
    } = useXmlHttp(url, "GET", {Authorization:`Bearer ${user.jwt}`});

    return (
        <>
            {/* {error && <div>{error}</div>} */}
            {isLoading &&
                <div className="image-loading">
                    Please wait while data is being loaded
                    <img src={require(`../loading.gif`)} alt="Loading ......"/>
                </div>}
            {allergen && 
            <>
                {setSubHeading(allergen.name)}
                <div className="allergen-details">
                    <div className="allergen-info">
                        <div><strong>ID</strong>: {allergen.allergenID}</div>
                        <div><strong>Item Name</strong>: {allergen.name}</div>
                        <div><strong>Description</strong>: {allergen.description}</div>
                    </div>
                </div>
                <div className="allergen-classes">
                    <Outlet/>
                </div>
            </>}
        </>
    );
};

export default Allergen;
