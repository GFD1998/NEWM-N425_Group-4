import {settings} from "../../config/config";
import useXmlHttp from '../../services/useXmlHttp';
import {useParams, Link, Outlet, useOutletContext} from "react-router-dom";
import './menuitem.css';
import {useAuth} from "../../services/useAuth";

const MenuItem = () => {
    const {user} = useAuth();
    const [subHeading, setSubHeading] = useOutletContext();
    const menuitemId = window.location.toString().split("menuitems/")[1];
    const url = settings.baseApiUrl + "/menuitems/" + menuitemId;
    console.log(url);
    const {
        error,
        isLoading,
        data: menuitem
    } = useXmlHttp(url, "GET", {Authorization:`Bearer ${user.jwt}`});

    return (
        <>
            {/* {error && <div>{error}</div>} */}
            {isLoading &&
                <div className="image-loading">
                    Please wait while data is being loaded
                    <img src={require(`../loading.gif`)} alt="Loading ......"/>
                </div>}
            {menuitem && 
            <>
                {setSubHeading(menuitem.name)}
                <div className="menuitem-details">
                    {/* <div className="menuitem-name">{menuitem.name}</div>*/}
                    <div className="menuitem-info">
                        <div><strong>ID</strong>: {menuitem.itemID}</div>
                        <div><strong>Item Name</strong>: {menuitem.name}</div>
                        <div><strong>Description</strong>: {menuitem.description}</div>
                        <div><strong>Price</strong>: {menuitem.price}</div>
                        {/* <div><strong>Ingredients</strong>:
                            <Link to={`menuitemingredients/${menuitem.itemID}`}> Click here to view ingredients</Link>
                        </div> */}
                    </div>
                    {/* <div className="menuitem-photo">
                        <img src={menuitem.image} alt={menuitem.name} id={menuitem.itemID}/>
                    </div> */}
                </div>
                <div className="menuitem-classes">
                    <Outlet/>
                </div>
            </>}
        </>
    );
};

export default MenuItem;
