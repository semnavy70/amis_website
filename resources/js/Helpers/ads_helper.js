export default {
    methods: {
        getAds(list,blog,isSingle=false){
            const ads = list.filter((a)=>a.blog===blog);
            if(!ads){
                return null;
            }
            if(isSingle){
                return ads[0]??null;
            }
            return ads;
        }
    }
}
