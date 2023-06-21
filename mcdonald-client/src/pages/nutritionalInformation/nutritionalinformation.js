import {settings} from "../../config/config";
import useXmlHttp from '../../services/useXmlHttp';
import {useParams, Link, Outlet, useOutletContext} from "react-router-dom";
import './nutritionalinformation.css';
import {useAuth} from "../../services/useAuth";

const NutritionalInformation = () => {
    const {user} = useAuth();
    const [subHeading, setSubHeading] = useOutletContext();
    const nutritionalinformationId = window.location.toString().split("nutritionalinformations/")[1];
    const url = settings.baseApiUrl + "/nutritionalinformation/" + nutritionalinformationId;
    console.log(url);
    const {
        error,
        isLoading,
        data: nutritionalinformation
    } = useXmlHttp(url, "GET", {Authorization:`Bearer ${user.jwt}`});

    return (
        <>
            {/* {error && <div>{error}</div>} */}
            {isLoading &&
                <div className="image-loading">
                    Please wait while data is being loaded
                    <img src={require(`../loading.gif`)} alt="Loading ......"/>
                </div>}
            {nutritionalinformation && 
            <>
                {setSubHeading(nutritionalinformation.nutritionalInformationID)}
                <div className="nutritionalinformation-details">
                    {/* <div className="nutritionalinformation-name">{nutritionalinformation.name}</div>*/}
                    <div className="nutritionalinformation-info">
                        <div><strong>ID</strong>: {nutritionalinformation.nutritionalInformationID}</div>
                        <div><strong>Menu Item</strong>: {nutritionalinformation.name}</div>
                        <div><strong>Serving Size</strong>: {nutritionalinformation.servingSize}</div>
                        <div><strong>Calories</strong>: {nutritionalinformation.calories}</div>
                        <div><strong>Total Fat</strong>: {nutritionalinformation.totalFat}</div>
                        <div><strong>Sodium</strong>: {nutritionalinformation.sodium}</div>
                        <div><strong>Cholesterol</strong>: {nutritionalinformation.cholesterol}</div>
                        <div><strong>Carbohydrates</strong>: {nutritionalinformation.carbohydrates}</div>
                        <div><strong>Sugars</strong>: {nutritionalinformation.sugars}</div>
                        <div><strong>Protein</strong>: {nutritionalinformation.protein}</div>
                        <div><strong>Vitamin A</strong>: {nutritionalinformation.vitaminA}</div>
                        <div><strong>Vitamin C</strong>: {nutritionalinformation.vitaminC}</div>
                        <div><strong>Calcium</strong>: {nutritionalinformation.calcium}</div>
                        <div><strong>Iron</strong>: {nutritionalinformation.iron}</div>
                    </div>
                </div>
                <div className="nutritionalinformation-classes">
                    <Outlet/>
                </div>
            </>}
        </>
    );
};

export default NutritionalInformation;
