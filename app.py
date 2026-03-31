from fastapi import FastAPI
from pydantic import BaseModel
from fastapi.middleware.cors import CORSMiddleware
import requests

app = FastAPI()

# CORS FIX
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

class ChatRequest(BaseModel):
    message: str
    page: str

@app.post("/chat")
def chat(req: ChatRequest):
    try:
        prompt = f"You are a travel expert. Page: {req.page}. User: {req.message}"

        response = requests.post(
            "http://localhost:11434/api/generate",
            json={
                "model": "llama3",
                "prompt": prompt,
                "stream": False
            }
        )

        data = response.json()

        return {"response": data.get("response", "No response from AI")}

    except Exception as e:
        print("ERROR:", e)
        return {"response": "AI server not running. Please start Ollama."}